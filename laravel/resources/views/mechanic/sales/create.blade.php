@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-plus-circle me-2"></i>Nueva Venta
            </h1>
        </div>
        <a href="{{ route('mechanic.sales.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-success text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-cash-register me-2"></i>Registrar Nueva Venta
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mechanic.sales.store') }}" method="POST" id="saleForm">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idUser" class="form-label fw-bold">Cliente *</label>
                            <select class="form-select @error('idUser') is-invalid @enderror" 
                                    id="idUser" name="idUser" required>
                                <option value="">Seleccionar Cliente</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->idUser }}" 
                                        {{ old('idUser') == $client->idUser ? 'selected' : '' }}>
                                        {{ $client->firstName }} {{ $client->lastName }} - {{ $client->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idUser')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="saleDate" class="form-label fw-bold">Fecha de Venta *</label>
                            <input type="datetime-local" 
                                   class="form-control @error('saleDate') is-invalid @enderror" 
                                   id="saleDate" name="saleDate" 
                                   value="{{ old('saleDate', now()->format('Y-m-d\TH:i')) }}" 
                                   required>
                            @error('saleDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sección para agregar productos -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-shopping-cart me-2"></i>Productos de la Venta
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="productSelect" class="form-label fw-bold">Producto *</label>
                                <select class="form-select" id="productSelect">
                                    <option value="">Seleccionar Producto</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->idPart }}" 
                                                data-price="{{ $product->price }}"
                                                data-stock="{{ $product->stock }}"
                                                data-name="{{ $product->name }}">
                                            {{ $product->name }} - Stock: {{ $product->stock }} - Bs{{ number_format($product->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="quantity" class="form-label fw-bold">Cantidad *</label>
                                <input type="number" class="form-control" id="quantity" value="1" min="1">
                            </div>
                            <div class="col-md-3">
                                <label for="unitPrice" class="form-label fw-bold">Precio Unitario</label>
                                <div class="input-group">
                                    <span class="input-group-text">Bs</span>
                                    <input type="number" step="0.01" class="form-control" id="unitPrice" readonly>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="button" class="btn btn-success btn-sm" id="addProduct">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de productos agregados -->
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered" id="productsTable">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody">
                                    <!-- Los productos se agregarán aquí dinámicamente -->
                                </tbody>
                                <tfoot class="table-primary">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">TOTAL VENTA:</td>
                                        <td class="fw-bold" id="saleTotal">Bs 0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('mechanic.sales.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="fas fa-save me-1"></i> Registrar Venta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('productSelect');
    const quantityInput = document.getElementById('quantity');
    const unitPriceInput = document.getElementById('unitPrice');
    const addProductBtn = document.getElementById('addProduct');
    const productsTableBody = document.getElementById('productsTableBody');
    const saleTotal = document.getElementById('saleTotal');
    const saleForm = document.getElementById('saleForm');
    const submitBtn = document.getElementById('submitBtn');

    let products = [];
    let total = 0;

    // Actualizar precio unitario cuando se selecciona un producto
    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            unitPriceInput.value = selectedOption.getAttribute('data-price');
            quantityInput.max = selectedOption.getAttribute('data-stock');
        } else {
            unitPriceInput.value = '';
        }
    });

    // Agregar producto a la tabla
    addProductBtn.addEventListener('click', function() {
        const productId = productSelect.value;
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        
        if (!productId) {
            alert('Por favor seleccione un producto');
            return;
        }

        const quantity = parseInt(quantityInput.value);
        const unitPrice = parseFloat(unitPriceInput.value);
        const productName = selectedOption.getAttribute('data-name');
        const stock = parseInt(selectedOption.getAttribute('data-stock'));

        if (quantity < 1) {
            alert('La cantidad debe ser al menos 1');
            return;
        }

        if (quantity > stock) {
            alert(`Stock insuficiente. Stock disponible: ${stock}`);
            return;
        }

        const productTotal = quantity * unitPrice;

        // Agregar a la lista
        products.push({
            idPart: productId,
            productName: productName,
            quantity: quantity,
            unitPrice: unitPrice,
            totalPrice: productTotal
        });

        // Actualizar tabla
        updateProductsTable();

        // Limpiar formulario
        productSelect.value = '';
        quantityInput.value = 1;
        unitPriceInput.value = '';

        // Actualizar total
        updateTotal();
    });

    // Actualizar tabla de productos
    function updateProductsTable() {
        productsTableBody.innerHTML = '';
        
        products.forEach((product, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${product.productName}</td>
                <td>${product.quantity}</td>
                <td>Bs ${product.unitPrice.toFixed(2)}</td>
                <td>Bs ${product.totalPrice.toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(${index})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            productsTableBody.appendChild(row);
        });

        // Agregar campos hidden al formulario
        updateFormProducts();
    }

    // Remover producto
    window.removeProduct = function(index) {
        products.splice(index, 1);
        updateProductsTable();
        updateTotal();
    };

    // Actualizar total
    function updateTotal() {
        total = products.reduce((sum, product) => sum + product.totalPrice, 0);
        saleTotal.textContent = `Bs ${total.toFixed(2)}`;
    }

    // Agregar productos al formulario como campos hidden
    function updateFormProducts() {
        // Remover productos anteriores
        document.querySelectorAll('input[name^="products"]').forEach(input => input.remove());

        // Agregar nuevos productos
        products.forEach((product, index) => {
            const prefix = `products[${index}]`;
            
            const idPartInput = document.createElement('input');
            idPartInput.type = 'hidden';
            idPartInput.name = `${prefix}[idPart]`;
            idPartInput.value = product.idPart;
            saleForm.appendChild(idPartInput);

            const quantityInput = document.createElement('input');
            quantityInput.type = 'hidden';
            quantityInput.name = `${prefix}[quantity]`;
            quantityInput.value = product.quantity;
            saleForm.appendChild(quantityInput);
        });
    }

    // Validar formulario antes de enviar
    saleForm.addEventListener('submit', function(e) {
        if (products.length === 0) {
            e.preventDefault();
            alert('Debe agregar al menos un producto a la venta');
            return;
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Procesando...';
    });
});
</script>
@endsection