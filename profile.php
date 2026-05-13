<?php
// This PHP file renders the Smart Waste Pickup webpage with real images and a live city map embedded.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smart Waste Pickup</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
   <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background: #f5fcf5;
      font-family: 'Poppins', 'Segoe UI', sans-serif;
    }
    .hero {
      background: url('https://images.unsplash.com/photo-1603969409447-48b6e3a1c00c?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
      padding: 120px 20px;
      text-align: center;
      border-radius: 25px;
      position: relative;
      color: white;
    }
    .hero::after {
      content: "";
      background: rgba(0, 0, 0, 0.5);
      position: absolute;
      inset: 0;
      border-radius: 25px;
    }
    .hero .content {
      position: relative;
      z-index: 1;
    }
    .service-card img {
      height: 160px;
      object-fit: cover;
      width: 100%;
    }
    .map-container {
      width: 100%;
      height: 500px;
      border-radius: 12px;
      overflow: hidden;
      margin-top: 40px;
    }
    .chatbot-btn {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    z-index: 1000;
  }

  .chatbot-window {
    position: fixed;
    bottom: 95px;
    right: 25px;
    width: 320px;
    height: 420px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    display: none;
    flex-direction: column;
    overflow: hidden;
    z-index: 999;
  }

  .chatbot-header {
    background: #28a745;
    color: white;
    padding: 12px;
    font-weight: bold;
  }

  .chatbot-body {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    font-size: 14px;
    background: #f9f9f9;
  }

  .chatbot-input {
    display: flex;
    border-top: 1px solid #ccc;
  }

  .chatbot-input input {
    flex: 1;
    border: none;
    padding: 10px;
    font-size: 14px;
    outline: none;
  }

  .chatbot-input button {
    border: none;
    background: #28a745;
    color: white;
    padding: 10px 16px;
  }

  .chatbot-body div {
    margin-bottom: 8px;
  }
.hero {
  position: relative;
  height: 500px;
  border-radius: 25px;
  overflow: hidden;
  color: white;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1;
}

.hero .content {
  position: relative;
  z-index: 2;
}

.hero-slideshow {
  position: absolute;
  inset: 0;
  z-index: 0;
  background-size: cover;
  background-position: center;
  transition: background-image 1s ease-in-out;
}
.hero-slideshow .slide {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 1s ease-in-out;
  background-size: cover;
  background-position: center;
}

.hero-slideshow .slide.active {
  opacity: 1;
}

</style>
</head>
<body>
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll("#heroSlideshow .slide");
    let current = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle("active", i === index);
      });
    }

    function nextSlide() {
      current = (current + 1) % slides.length;
      showSlide(current);
    }

    showSlide(current);
    setInterval(nextSlide, 5000); // 5 seconds per slide
  });
</script>


  <!-- Floating Button -->
<button class="chatbot-btn" onclick="toggleChat()">💬</button>

<!-- Chat Window -->
<div class="chatbot-window" id="chatbotWindow">
  <div class="chatbot-header">🤖 SmartWaste Assistant</div>
  <div class="chatbot-body" id="chatBody">
    <div><strong>Bot:</strong> Hi! Need help with scheduling, emergencies, or services?</div>
  </div>
  <div class="chatbot-input">
    <input type="text" id="userInput" placeholder="Ask me anything..." />
    <button onclick="sendMessage()">Send</button>
  </div>
</div>

<!-- Chatbot Logic -->
<script>
  function toggleChat() {
    const chatbot = document.getElementById('chatbotWindow');
    chatbot.style.display = chatbot.style.display === 'flex' ? 'none' : 'flex';
    chatbot.style.flexDirection = 'column';
  }

  function sendMessage() {
    const input = document.getElementById("userInput");
    const message = input.value.trim();
    if (!message) return;

    const chatBody = document.getElementById("chatBody");
    const userMsg = document.createElement("div");
    userMsg.innerHTML = `<strong>You:</strong> ${message}`;
    chatBody.appendChild(userMsg);
    input.value = "";

    setTimeout(() => {
      const botMsg = document.createElement("div");
      botMsg.innerHTML = `<strong>Bot:</strong> ${generateBotReply(message)}`;
      chatBody.appendChild(botMsg);
      chatBody.scrollTop = chatBody.scrollHeight;
    }, 600);
  }

  function generateBotReply(msg) {
    msg = msg.toLowerCase();
    if (msg.includes("schedule") || msg.includes("pickup")) {
      return "📅 You can schedule a pickup using the 'Schedule Pickup' button.";
    } else if (msg.includes("emergency")) {
      return "🚨 Use the 'Emergency' button for immediate assistance.";
    } else if (msg.includes("map") || msg.includes("location")) {
      return "🗺️ The map shows current garbage vehicle locations.";
    } else if (msg.includes("cleaner") || msg.includes("clean")) {
      return "🧹 Click on 'Cleaner Man' to request a cleaner.";
    } else if (msg.includes("disposal")) {
      return "🧪 Use 'Special Disposal' for e-waste, medical, or chemical waste.";
    } else {
      return "🤖 I'm here to assist! Ask about pickup, services, emergencies, or the live map.";
    }
  }
</script>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
  <a class="navbar-brand text-success" href="#">♻️ SmartWaste</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <div class="d-flex gap-2 mt-2 mt-lg-0">
      <button class="btn btn-sm btn-outline-success">🌐 Language</button>
      <button class="btn btn-sm btn-outline-primary">👤 Profile</button>
    </div>
  </div>
</nav>

<section class="hero my-4 d-flex align-items-center justify-content-center">

<div class="hero-slideshow" id="heroSlideshow">
  <div class="slide" style="background-image: url('images/slide1.jpg');"></div>
  <div class="slide" style="background-image: url('images/slide2.jpg');"></div>
  <div class="slide" style="background-image: url('images/slide3.jpg');"></div>
  <div class="slide" style="background-image: url('images/slide4.jpg');"></div>
  <div class="slide" style="background-image: url('images/slide5.jpg');"></div>
</div>

  <div class="content" data-aos="fade-up">
    <h1 class="display-5 fw-bold">Let’s Clean Together!</h1>
    <p class="lead">Book your next waste pickup in one click and make your city cleaner.</p>
    <a href="schedule.php" class="btn btn-success mt-3">📆 Schedule Pickup</a>
  </div>
</section>


<section class="container text-center my-5">
  <h3 class="mb-4">⚡ Quick Actions</h3>
  <div class="row g-4 justify-content-center">
    <div class="col-md-3" data-aos="zoom-in">
      <div class="card shadow-sm p-3">
        <img src="https://images.unsplash.com/photo-1576765607924-c3b7e9008c6c?fit=crop&w=600&q=80" class="img-fluid mb-2">
        <button class="btn btn-outline-danger w-100">🚨Emergency </button>
      </div>
    </div>
    <div class="col-md-3" data-aos="zoom-in">
      <div class="card shadow-sm p-3">
        <img src="https://images.unsplash.com/photo-1597091529726-cb9285f13247?fit=crop&w=600&q=80" class="img-fluid mb-2">
        <button class="btn btn-outline-primary w-100">🧹 Cleaner Man</button>
      </div>
    </div>
    <div class="col-md-3" data-aos="zoom-in">
      <div class="card shadow-sm p-3">
        <img src="https://images.unsplash.com/photo-1603252108932-e09f9584f128?fit=crop&w=600&q=80" class="img-fluid mb-2">
        <button class="btn btn-outline-warning w-100">🧪 Special Disposal</button>
      </div>
    </div>
    <div class="col-md-3" data-aos="zoom-in">
      <div class="card shadow-sm p-3">
        <img src="https://images.unsplash.com/photo-1616787437303-40aaf88cf0be?fit=crop&w=600&q=80" class="img-fluid mb-2">
        <button class="btn btn-outline-success w-100">📅 Subscription</button>
      </div>
    </div>
  </div>
</section>

<section class="container my-5">
  <h3 class="text-center mb-4">🛠️ Our Services</h3>
  <div class="row g-4">
    <?php
    $services = [
      "Home Cleaning" => "https://images.unsplash.com/photo-1598300183922-826213cc9c54?fit=crop&w=600&q=80",
      "Drain Cleaning" => "https://images.unsplash.com/photo-1605005509642-1b54f6f93b5d?fit=crop&w=600&q=80",
      "Event Cleanup" => "https://images.unsplash.com/photo-1603570419881-3d75c1d146d0?fit=crop&w=600&q=80",
      "Electronic Waste" => "https://images.unsplash.com/photo-1610394212134-4b8f25b09f16?fit=crop&w=600&q=80"
    ];
    foreach ($services as $name => $img) {
      echo "<div class='col-md-3' data-aos='fade-up'>
              <div class='card service-card shadow-sm'>
                <img src='$img' class='img-fluid' alt='$name'>
                <div class='p-3 text-center'>
                  <h5>$name</h5>
                </div>
              </div>
            </div>";
    }
    ?>
  </div>
</section>

<section class="container" data-aos="fade-up">
  <h3 class="text-center">🗺️ Live City Map - Rajgurunagar Taluka</h3>
  <div id="map" class="map-container"></div>
  <p class="text-center mt-2 text-muted">🔍 Tracking live location of Ghantagadi vehicles in Rajgurunagar.</p>
</section>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000 });

  function initMap() {
    const rajgurunagar = { lat: 18.866, lng: 73.889 };

    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 14,
      center: rajgurunagar,
      mapTypeId: "roadmap"
    });

    const markers = [
      { lat: 18.867, lng: 73.890, title: "🧹 Garbage Collection Center" },
      { lat: 18.869, lng: 73.887, title: "♻️ RecycleMart Pvt. Ltd." },
      { lat: 18.865, lng: 73.892, title: "🧴 E-Waste Drop Zone" },
      { lat: 18.864, lng: 73.894, title: "🌱 Compost Facility" }
    ];

    markers.forEach(loc => {
      new google.maps.Marker({
        position: { lat: loc.lat, lng: loc.lng },
        map,
        title: loc.title,
        icon: "https://maps.google.com/mapfiles/ms/icons/green-dot.png"
      });
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJLb_10WP7sVy0xjOwgnq7nVr1PMGAXp0&callback=initMap" async defer></script>
</body>
</html> >