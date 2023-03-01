<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="carrito.css" rel="stylesheet" type="text/css">
    
    <title>Carrito de compras</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
        <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    color: white;
}
body {
    font-family: 'Roboto', sans-serif;
	font-weight: 300;
	background:
linear-gradient(27deg, #151515 5px, transparent 5px) 0 5px,
linear-gradient(207deg, #151515 5px, transparent 5px) 10px 0px,
linear-gradient(27deg, #222 5px, transparent 5px) 0px 10px,
linear-gradient(207deg, #222 5px, transparent 5px) 10px 5px,
linear-gradient(90deg, #1b1b1b 10px, transparent 10px),
linear-gradient(#1d1d1d 25%, #1a1a1a 25%, #1a1a1a 50%, transparent 50%, transparent 75%, #242424 75%, #242424);
background-color: #131313;
background-size: 20px 20px; 
    padding-top: 150px;
}
h1{
    font-family: 'Montserrat', sans-serif;
    text-align: center;
    margin: 30px 0px;
}
img {
    width: 320px;
    height: 340px;
    object-fit: cover;
    border-radius: 20px 20px 0px 0px;
}
header{
    display: flex;
    align-items: center;
    justify-content: center;
    gap:15%;
    height: 70px;
    top: 0;
    position: fixed;
    width: 100%;
}
.scroll{
    background-color: aliceblue;
    box-shadow: .1rem .2rem .3rem #333;
}
.scroll img{
    filter: invert(15%);
}           
.scroll h1{
    color: #141C29;
}
.carrito{
    filter: invert(100%);
    width: 45px;
    height: auto;
    margin-right: 25px;
}
.contenedor{
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 50px;
    margin-bottom: 20px;
    margin-top: 100px;
}
.contenedor>div{
    box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
    background-color: #353535;
    border-radius: 20px;
}
.contenedor>div:hover{
    background-color: #141414;
}

.informacion{
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap:15px;
}
.informacion>p:first-child{
    font-family: 'Montserrat', sans-serif;
    font-size: 25px;
    font-weight: 300;
}
.informacion .precio {
    font-size: 20px;
    font-weight: 500;
}
.informacion .precio span{
    font-size: 17px;
    font-weight: 300;
}
.informacion button{
    background-color: #1d1d1d;
    width: 100px;
    height: 35px;
    border-radius: 10px;
    border: none;

    font-size: 17px;
    font-weight: 300;
    cursor: pointer;
}
.informacion button:hover{
    background-color: #e8fc34c9;
}
</style>
</head>

<body>
    <header id="header">
        <h1>Shopping Car</h1> 
        <img class="carrito" src="carrito.png" alt="carrito">
    </header>
    <div id="contenedor" class="contenedor">
        <div>
            <img src="Productos/Alarma-Positron-Keyless-330.png" alt="producto 1">
            <div class="informacion">
                <p>Producto 1</p>
                <p class="precio">$199<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen2.webp" alt="producto 2">
            <div class="informacion">
                <p>Producto 2</p>                   
                <p class="precio">$299<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen3.webp" alt="producto 3">
            <div class="informacion">
                <p>Producto 3</p>                   
                <p class="precio">$399<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen4.webp" alt="producto 4">
            <div class="informacion">
                <p>Producto 4</p>                   
                <p class="precio">$499<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen5.webp" alt="producto 5">
            <div class="informacion">
                <p>Producto 5</p>                   
                <p class="precio">$599<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen6.webp" alt="producto 6">
            <div class="informacion">
                <p>Producto 6</p>                   
                <p class="precio">$699<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen7.webp" alt="producto 7">
            <div class="informacion">
                <p>Producto 7</p>                   
                <p class="precio">$799<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen8.webp" alt="producto 8">
            <div class="informacion">
                <p>Producto 8</p>                   
                <p class="precio">$899<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen9.webp" alt="producto 9">
            <div class="informacion">
                <p>Producto 9</p>                   
                <p class="precio">$999<span>.99</span></p>
                <button>Comprar</button>
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>

</html>