// don elements
const tbody = document.querySelector("#body");

const fetchData = async() => {
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
                    <i style="margin-right: 1rem;" class="fa-solid fa-pen-to-square text-primary"></i>
                    <i class="fa-solid fa-trash text-danger"></i>
                </td>
            </tr>
        `;
    });
}

fetchData();