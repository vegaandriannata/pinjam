<?php
session_start();
include("koneksi.php");

// Get the id_brg from the URL
$id_brg = isset($_GET['id_brg']) ? $_GET['id_brg'] : 0; // You may need to adjust this based on how you pass the id_brg.

$query = "SELECT id_brg, nama_brg, merek, kode_brg, tgl_pembelian, harga, qr, gambar, serial_key FROM barang WHERE id_brg = $id_brg";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($koneksi));
}

// Fetch product details and store them in an array
$productDetails = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Animated Product Card | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 
	 <style>
	 @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: linear-gradient(135deg, #43CBFF 10%, #9708CC 100%);
}
.product-card {
  position: relative;
  max-width: 355px;
  width: 100%;
  border-radius: 25px;
  padding: 20px 30px 30px 30px;
  background: #fff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  z-index: 3;
  overflow: hidden;
}
.product-card .logo-cart{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.product-card .logo-cart img{
  height: 60px;
  width: 60px;
  object-fit: cover;
}
.product-card .logo-cart i{
  font-size: 27px;
  color: #707070;
  cursor: pointer;
  transition: color 0.3s ease;
}
.product-card .logo-cart i:hover{
  color: #333;
}
.product-card .main-images{
  position: relative;
  height: 210px;
}
.product-card .main-images img{
  position: absolute;
  height: 300px;
  width: 300px;
  object-fit: cover;
  margin-top: 20px;
  border-radius: 25px;
  
  top: -10px;
  z-index: -1;
  opacity: 1;
  transition: opacity 0.5s ease;
}
.product-card .main-images img.active{
  opacity: 1;
}
.product-card .shoe-details .shoe_name{
  font-size: 24px;
  font-weight: 500;
  color: #161616;
}
.product-card .shoe-details p{
  font-size: 12px;
  font-weight: 400;
  color: #333;
  text-align: justify;
}
.product-card .shoe-details .stars i{
  margin: 0 -1px;
  color: #333;
}
.product-card .color-price .color-option{
  display: flex;
  align-items: center;
}
.color-price{
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}
.color-price .color-option .color{
  font-size: 18px;
  font-weight: 500;
  color: #333;
  margin-right: 8px;
}
.color-option  .circles{
  display: flex;
}
.color-option  .circles .circle{
  height: 18px;
  width: 18px;
  background: #0071C7;
  border-radius: 50%;
  margin: 0 4px;
  cursor: pointer;
  transition: all 0.4s ease;
}
.color-option  .circles .circle.blue.active{
  box-shadow: 0 0 0 2px #fff,
               0 0 0 4px #0071C7;
}
.color-option  .circles .circle.pink{
  background: #FA1795;
}
.color-option  .circles .circle.pink.active{
  box-shadow: 0 0 0 2px #fff,
               0 0 0 4px #FA1795;
}
.color-option  .circles .circle.yellow{
  background: #F5DA00;
}
.color-option  .circles .circle.yellow.active{
  box-shadow: 0 0 0 2px #fff,
               0 0 0 4px #F5DA00;
}
.color-price .price{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.color-price .price .price_num{
  font-size: 25px;
  font-weight: 600;
  color: #707070;
}
.color-price .price .price_letter{
  font-size: 10px;
  font-weight: 600;
  margin-top: -4px;
  color: #707070;
}
.color-price .tgl .price_letter{
  font-size: 10px;
  font-weight: 600;
  margin-top: -4px;
  color: #707070;
}

.color-price .price .tgl{
  font-size: 10px;
  font-weight: 600;
  margin-top: -4px;
  color: #707070;
}
.product-card .button{
  position: relative;
  height: 50px;
  width: 100%;
  border-radius: 25px;
  margin-top: 30px;
  overflow: hidden;
}
.product-card .button .button-layer{
  position: absolute;
  height: 100%;
  width: 300%;
  left: -100%;
  background-image: linear-gradient(135deg,#9708CC, #43CBFF,#9708CC, #43CBFF );
  transition: all 0.4s ease;
  border-radius: 25PX;
}
.product-card .button:hover .button-layer{
  left: 0;
}
.product-card .button button{
  position: relative;
  height: 100%;
  width: 100%;
  background: none;
  outline: none;
  border: none;
  font-size: 18px;
  font-weight: 600;
  letter-spacing: 1px;
  color: #fff;
}
	 </style>
	
   </head>
<body>
  <div class="product-card">
    
	
    <div class="main-images">
       <img id="blue" class="blue active" src="<?php echo $productDetails['gambar']; ?>" alt="Product Image">
      
    </div><br><br>
	<br><br>
    <div class="shoe-details">
      <span class="shoe_name"><?php echo $productDetails['nama_brg']; ?></span>
      <p>Merek : <?php echo $productDetails['merek']; ?></p>
	  <p>Serial Key : <?php echo $productDetails['serial_key']; ?></p>
	  
	
     
    </div>
    <div class="color-price">
      <div class="color-option">
	 <div class="price">

        <span class="color" style='
		background-color: #5bc0de;
		color: #fff;
		border-radius: 30px;
		padding: 5px 10px; /* Adjusted padding values for top/bottom and left/right */
		letter-spacing: 2px;
		margin: 0 auto; /* Center the element horizontally */'>
		<p><?php echo $productDetails['kode_brg']; ?></p></span>
		
        
      </div>
	  </div>
      <div class="price">
    <?php
    // Format the price before echoing
    $formattedHarga = "Rp " . number_format($productDetails['harga'], 0, ',', '.');
    
    // Format the date to display only day, month, and year
    $formattedDate = date('j M Y', strtotime($productDetails['tgl_pembelian']));
    ?>
    
    <span class="price_num"><?php echo $formattedHarga; ?></span>
    <span class="price_letter"><?php echo $formattedDate; ?></span>
</div>
    </div>
    <!--<div class="button" onclick="goToDashboard()">
  <div class="button-layer"></div>
  <button>Dashboard</button>
</div>-->

  </div>
  
  
  <script>
  function goToDashboard() {
    window.location.href = "dashboard-barang.php";
  }

  let circle = document.querySelector(".color-option");
  circle.addEventListener("click", (e) => {
    let target = e.target;
    if (target.classList.contains("circle")) {
      circle.querySelector(".active").classList.remove("active");
      target.classList.add("active");
      document.querySelector(".main-images .active").classList.remove("active");
      document.querySelector(`.main-images .${target.id}`).classList.add("active");
    }
  });
</script>
</body>
</html>