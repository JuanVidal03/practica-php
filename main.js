// don elements

const fetchData = async() => {
    const res = await fetch('./productosDAO.php');
    const data = await res.json();
    console.log(data);
}

fetchData();