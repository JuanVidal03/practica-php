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
                        ></i>
                        <i
                            class="fa-solid fa-trash text-danger"
                            onclick="deleteProduct(${producto.id})"
                        ></i>
                    </td>
                </tr>
            `;
        });

    } catch (error) {
        console.log(`Error al renderizar los productos: ${error.message}`);
    }
}
allProducts();

// eliminar producto
const deleteProduct = async(id) => {
    try {

        const res = await fetch(`./controllers/deleteProductController.php?id=${id}`, {
            method: 'DELETE'
        });

        location.reload();

    } catch (error) {
        console.log(`Error al eliminar producto: ${error}`);
    }
}


// datos del formulario
const form = document.querySelector('form');

const formFields = () => {

    const formData = new FormData(form);

    const tituloField = formData.get('titulo');
    const precioField = parseFloat(formData.get('precio'));
    const stockField = parseInt(formData.get('stock'));
    const descripcionField = formData.get('descripcion');
    
    const data = { tituloField, descripcionField, precioField, stockField };
    return data;

}


// agregar producto
const addProduct = async() => {

    const data = formFields();
    const { tituloField, descripcionField, precioField, stockField } = data;

    try {
        const res = await fetch(
            `./controllers/addProductController.php?titulo=${tituloField}&descripcion=${descripcionField}&precio=${precioField}&stock=${stockField}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: data,
            }
        );

    } catch (error) {
        console.log(`Error al agregar producto: ${error}`);
    }

}

// evento del formulario
form.addEventListener("submit", (e) => {
    addProduct();
})