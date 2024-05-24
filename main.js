// don elements
const tbody = document.querySelector("#body");

// renderizando productos
const allProducts = async() => {
    try {
        
        const res = await fetch("./controllers/allProductosController.php");
        const data = await res.json();
    
        data.forEach(producto => {
            tbody.innerHTML += `
                <tr>
                    <th class="text-center">${producto.id}</th>
                    <td class="text-center">${producto.titulo}</td>
                    <td class="text-center">${producto.descripcion}</td>
                    <td class="text-center">$${producto.precio} COP</td>
                    <td class="text-center">${producto.stock}</td>
                    <td class="text-center">
                        <i
                            style="margin-right: 1rem;"
                            class="fa-solid fa-pen-to-square text-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#formModal"
                            onclick="showProductOnFormFields(${producto.id})"
                        ></i>
                        <i
                            class="fa-solid fa-trash text-danger"
                            data-bs-target="#deleteModal"
                            data-bs-toggle="modal"
                            onclick="deleteProduct(${producto.id})"
                        ></i>
                    </td>
                </tr>
            `;
        });

    } catch (error) {
        console.log(`Error al renderizar los productos: ${error.message}`);
        console.log(error);
    }
}
allProducts();

// eliminar producto
const deleteProduct = (id) => {
    try {
        // seleccionar el boton de eliminar y eliminar el producto
        const deleteButton = document.querySelector('#delete-button');
        deleteButton.addEventListener('click', async() => {
            await fetch(`./controllers/deleteProductController.php?id=${id}`, {
                method: 'DELETE'
            });
            location.reload();
        })


    } catch (error) {
        console.log(`Error al eliminar producto: ${error}`);
    }
}

// datos del formulario
const form = document.querySelector('form');
const formFields = () => {

    const id = document.querySelector('#id');
    const titulo = document.querySelector('#titulo');
    const descripcion = document.querySelector('#descripcion');
    const precio = document.querySelector('#precio');
    const stock = document.querySelector('#stock');

    const data = { id, titulo, descripcion, precio, stock }
    return data;
}

// agregar producto
const addProduct = async() => {

    const data = formFields();
    const { titulo, descripcion, precio, stock } = data;

    try {
        const res = await fetch(
            `./controllers/addProductController.php?titulo=${titulo.value}&descripcion=${descripcion.value}&precio=${precio.value}&stock=${stock.value}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: data,
            }
        );
        location.reload();

    } catch (error) {
        console.log(`Error al agregar producto: ${error}`);
    }

}

// mostrar valores en los campos del formulario
const showProductOnFormFields = async (idProduct) => {

    // actualizando titulo del formulario
    const title = document.querySelector('.title');
    title.textContent = 'Actualizar producto';
    
    // valores del formulario
    const data = formFields();
    const { id, titulo, descripcion, precio, stock } = data;

    // encontrar producto
    const resFindProduct = await fetch(`./controllers/productByIdController.php?id=${idProduct}`);
    const findProduct = await resFindProduct.json();
    
    // actualizar valores del formulario
    id.value = findProduct.id
    titulo.value = findProduct.titulo;
    descripcion.value = findProduct.descripcion;
    precio.value = findProduct.precio;
    stock.value = findProduct.stock;

}

// actualizar producto
const updateProduct = async() => {

    const data = formFields();
    const { id, titulo, descripcion, precio, stock } = data;

    try {

        const updatedProduct = {
            id: id.value,
            titulo: titulo.value,
            descripcion: descripcion.value,
            precio: parseFloat(precio.value),
            stock: parseInt(stock.value)
        }

        // actualizar producto
        const res = await fetch(`./controllers/updateProductController.php?id=${updatedProduct.id}&titulo=${updatedProduct.titulo}&descripcion=${updatedProduct.descripcion}&precio=${updatedProduct.precio}&stock=${updatedProduct.stock}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: updatedProduct
        });
        location.reload();


    } catch (error) {
        console.log(`Error al actualizar producto: ${error}`);
    }
}


// evento del formulario
form.addEventListener("submit", (e) => {
    e.preventDefault();
    addProduct();
    // updateProduct();
})


// cambiando el titulo del modal
const addButton = document.querySelector('.add-button');
addButton.addEventListener('click', () => {
    const title = document.querySelector('.title');
    title.textContent = 'Agregar producto';
})