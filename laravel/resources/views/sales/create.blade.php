@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Nueva Venta</h1>
    
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
        <li class="breadcrumb-item active">Nueva Venta</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>Registrar Nueva Venta
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
                @csrf
                
                <!-- Información básica de la venta -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idUser" class="form-label">Cliente *</label>
                            <select class="form-select @error('idUser') is-invalid @enderror" 
                                    id="idUser" name="idUser" required>
                                <option value="">Seleccionar Cliente</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->idUser }}" 
                                        {{ old('idUser') == $user->idUser ? 'selected' : '' }}>
                                        {{ $user->firstName }} {{ $user->lastName }} - {{ $user->email }}
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
                            <label for="saleDate" class="form-label">Fecha de Venta *</label>
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

                <!-- Detalles de la venta -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="mb-3">
                            <i class="fas fa-list me-2"></i>Productos de la Venta
                        </h5>
                        
                        <!-- Formulario para agregar productos -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Agregar Producto</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="productSelect" class="form-label">Producto</label>
                                        <select class="form-select" id="productSelect">
                                            <option value="">Seleccionar Producto</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->idPart }}" 
                                                        data-price="{{ $product->price }}"
                                                        data-stock="{{ $product->stock }}"
                                                        data-name="{{ $product->name }}"
                                                        data-category="{{ $product->category }}">
                                                    {{ $product->name }} - Stock: {{ $product->stock }} - Bs{{ number_format($product->price, 2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="quantity" class="form-label">Cantidad </label>
                                        <input type="number" class="form-control" id="quantity" value="1" min="1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unitPrice" class="form-label">Precio Unitario</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Bs</span>
                                            <input type="number" step="0.01" class="form-control" id="unitPrice" value="0.00">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Acciones</label>
                                        <div>
                                            <button type="button" class="btn btn-success btn-sm" id="addProduct">
                                                <i class="fas fa-plus me-1"></i> Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de productos agregados -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="productsTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody">
                                    <!-- Los productos se agregarán aquí dinámicamente -->
                                </tbody>
                                <tfoot class="table-secondary">
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">TOTAL VENTA:</td>
                                        <td class="fw-bold" id="saleTotal">Bs 0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save me-1"></i> Guardar Venta
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
            const price = selectedOption.getAttribute('data-price');
            unitPriceInput.value = parseFloat(price).toFixed(2);
            // Actualizar cantidad máxima según stock
            quantityInput.max = selectedOption.getAttribute('data-stock');
        } else {
            unitPriceInput.value = '0.00';
        }
    });

    // Permitir al usuario modificar el precio manualmente
    unitPriceInput.addEventListener('change', function() {
        // Validar que el precio no sea negativo
        if (this.value < 0) {
            this.value = '0.00';
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
        let unitPrice = parseFloat(unitPriceInput.value);
        const productName = selectedOption.getAttribute('data-name');
        const category = selectedOption.getAttribute('data-category');
        const stock = parseInt(selectedOption.getAttribute('data-stock'));

        if (quantity < 1) {
            alert('La cantidad debe ser al menos 1');
            return;
        }

        if (quantity > stock) {
            alert(`Stock insuficiente. Stock disponible: ${stock}`);
            return;
        }

        // Si el usuario no ingresó precio, usar el precio por defecto del producto
        if (unitPrice <= 0) {
            unitPrice = parseFloat(selectedOption.getAttribute('data-price'));
            unitPriceInput.value = unitPrice.toFixed(2);
        }

        const productTotal = quantity * unitPrice;

        // Verificar si el producto ya está agregado
        const existingIndex = products.findIndex(p => p.idPart == productId);
        if (existingIndex !== -1) {
            // Si el producto ya existe, preguntar si quiere actualizar o agregar como nuevo
            if (confirm('Este producto ya está en la lista. ¿Desea actualizar la cantidad y precio?')) {
                products[existingIndex].quantity = quantity;
                products[existingIndex].unitPrice = unitPrice;
                products[existingIndex].totalPrice = productTotal;
            } else {
                // Agregar como nuevo producto (puede ser útil para diferentes precios)
                products.push({
                    idPart: productId,
                    productName: productName,
                    category: category,
                    quantity: quantity,
                    unitPrice: unitPrice,
                    totalPrice: productTotal
                });
            }
        } else {
            // Agregar nuevo producto
            products.push({
                idPart: productId,
                productName: productName,
                category: category,
                quantity: quantity,
                unitPrice: unitPrice,
                totalPrice: productTotal
            });
        }

        // Actualizar tabla
        updateProductsTable();

        // Limpiar formulario
        productSelect.value = '';
        quantityInput.value = 1;
        unitPriceInput.value = '0.00';

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
                <td>${product.category || 'N/A'}</td>
                <td>${product.quantity}</td>
                <td>Bs ${product.unitPrice.toFixed(2)}</td>
                <td>Bs ${product.totalPrice.toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm me-1" onclick="editProduct(${index})" title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(${index})" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            productsTableBody.appendChild(row);
        });

        // Agregar campos hidden al formulario
        updateFormProducts();
    }

    // Función para editar producto
    window.editProduct = function(index) {
        const product = products[index];
        
        // Llenar el formulario con los datos del producto
        productSelect.value = product.idPart;
        quantityInput.value = product.quantity;
        unitPriceInput.value = product.unitPrice.toFixed(2);
        
        // Remover el producto de la lista (será re-agregado con los cambios)
        products.splice(index, 1);
        updateProductsTable();
        updateTotal();
        
        // Hacer scroll al formulario de agregar
        document.getElementById('productSelect').scrollIntoView({ behavior: 'smooth' });
    };

    // Remover producto
    window.removeProduct = function(index) {
        if (confirm('¿Está seguro de eliminar este producto de la venta?')) {
            products.splice(index, 1);
            updateProductsTable();
            updateTotal();
        }
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

            const unitPriceInput = document.createElement('input');
            unitPriceInput.type = 'hidden';
            unitPriceInput.name = `${prefix}[unitPrice]`;
            unitPriceInput.value = product.unitPrice;
            saleForm.appendChild(unitPriceInput);
        });
    }

    // Validar formulario antes de enviar
    saleForm.addEventListener('submit', function(e) {
        if (products.length === 0) {
            e.preventDefault();
            alert('Debe agregar al menos un producto a la venta');
            return;
        }

        // Validar que todos los precios sean mayores a 0
        const invalidProducts = products.filter(p => p.unitPrice <= 0);
        if (invalidProducts.length > 0) {
            e.preventDefault();
            alert('Todos los productos deben tener un precio mayor a 0');
            return;
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Procesando...';
    });

    // Inicializar el campo de precio
    unitPriceInput.value = '0.00';
});
</script>
@endsection