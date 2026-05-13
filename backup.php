<?php
// This PHP file renders the Smart Waste Pickup webpage with real images, a live city map, and multi-language support.
// For full multi-language functionality and dynamic content, backend integration (e.g., database, API) is required.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cleancity360 - Rajgurunagar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="spreadsheet" href="base.css">
    <script src="https://kit.fontawesome.com/a2e0d5b7d4.js" crossorigin="anonymous"></script>

<!-- Include html5-qrcode library -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="base.css" rel="stylesheet">
</head>
<body>
<script>
const translations = {
  en: {
    brand: "SmartWaste",
    language: "",
    home: "",
    profile: "<i class=\"fas fa-cog\"></i>",
    heroTitle: "Let’s Clean Together!",
    heroSubtitle: "Book your next waste pickup in one click and make your city cleaner.",
    schedulePickup: "📆 Schedule Pickup",
    quickActions: "⚡ Quick Actions",
    emergency: "🚨 Emergency",
    cleanerMan: "🧹 Cleaner Man",
    specialDisposal: "🧪 Special Disposal",
    subscription: "📅 Subscription",
    liveMapTitle: "🗺️ Live City Map - Rajgurunagar Taluka",
    mapDescription: "🔍 Tracking live location of Ghantagadi vehicles in Rajgurunagar.",
    chatbotHeader: "🤖 SmartWaste Assistant",
    chatbotInitialBot: "Hi there! I'm your SmartWaste Assistant. How can I help you today? You can ask about scheduling, emergency services, vehicle locations, or special disposal.",
    chatbotPlaceholder: "Ask me anything...",
    send: "Send",
    scheduleReply: "📅 You can easily schedule a pickup by clicking on the 'Schedule Pickup' button on the homepage. Just choose your preferred date and time.",
    emergencyReply: "🚨 For immediate assistance with waste-related emergencies, please click the 'Emergency' button under Quick Actions. Our team will be dispatched promptly.",
    mapReply: "🗺️ The live map on the page shows the real-time locations of our Ghantagadi waste collection vehicles, so you can track them.",
    cleanerReply: "🧹 To request a cleaner for specific tasks, please use the 'Cleaner Man' button. You can specify the type of cleaning needed.",
    disposalReply: "🧪 For electronic waste, medical waste, or chemical waste, please utilize the 'Special Disposal' service. This ensures safe and proper handling.",
    defaultReply: "🤖 I'm here to assist you with common queries. Please ask about pickup scheduling, available services, emergency procedures, or how to use the live map.",
    footerAbout: "About Us",
    footerContact: "Contact",
    footerPrivacy: "Privacy Policy",
    footerTerms: "Terms of Service",
    footerConnect: "Connect With Us",
    allRightsReserved: "All rights reserved."
  },
  hi: {
    brand: "स्मार्टवेस्ट",
    language: "",
    home: "",
    profile: "<i class=\"fas fa-cog\"></i>",
    heroTitle: "चलो मिलकर साफ करें!",
    heroSubtitle: "एक क्लिक में अपनी अगली कचरा पिकअप बुक करें और अपने शहर को स्वच्छ बनाएं।",
    schedulePickup: "📆 पिकअप शेड्यूल करें",
    quickActions: "⚡ त्वरित कार्य",
    emergency: "🚨 आपातकालीन",
    cleanerMan: "🧹 क्लीनर मैन",
    specialDisposal: "🧪 विशेष निपटान",
    subscription: "📅 सदस्यता",
    liveMapTitle: "🗺️ लाइव सिटी मैप - राजगुरुनगर तालुका",
    mapDescription: "🔍 राजगुरुनगर में घंटागाड़ी वाहनों के लाइव स्थान को ट्रैक करना।",
    chatbotHeader: "🤖 स्मार्टवेस्ट सहायक",
    chatbotInitialBot: "नमस्ते! मैं आपका स्मार्टवेस्ट सहायक हूँ। मैं आज आपकी कैसे मदद कर सकता हूँ? आप शेड्यूलिंग, आपातकालीन सेवाओं, वाहन स्थानों या विशेष निपटान के बारे में पूछ सकते हैं।",
    chatbotPlaceholder: "मुझसे कुछ भी पूछें...",
    send: "भेजें",
    footerAbout: "हमारे बारे में",
    footerContact: "संपर्क करें",
    footerPrivacy: "गोपनीयता नीति",
    footerTerms: "सेवा की शर्तें",
    footerConnect: "हमसे जुड़ें",
    allRightsReserved: "सभी अधिकार सुरक्षित।"
  },
  mr: {
    brand: "स्मार्टवेस्ट",
    language: "",
    home: "",
    profile: "<i class=\"fas fa-cog\"></i>",
    heroTitle: "चला एकत्र स्वच्छ करूया!",
    heroSubtitle: "एका क्लिकमध्ये आपले पुढील कचरा संकलन बुक करा आणि आपले शहर स्वच्छ करा.",
    schedulePickup: "📆 पिकअप शेड्यूल करा",
    quickActions: "⚡ जलद कृती",
    emergency: "🚨 आपत्कालीन",
    cleanerMan: "🧹 क्लिनर माणूस",
    specialDisposal: "🧪 विशेष विल्हेवाट",
    subscription: "📅 सदस्यता",
    liveMapTitle: "🗺️ लाईव्ह सिटी मॅप - राजगुरुनगर तालुका",
    mapDescription: "🔍 राजगुरुनगरमधील घंटागाडी वाहनांचे लाईव्ह लोकेशन ट्रॅक करत आहे.",
    chatbotHeader: "🤖 स्मार्टवेस्ट सहाय्यक",
    chatbotInitialBot: "नमस्कार! मी तुमचा स्मार्टवेस्ट सहाय्यक आहे. मी तुम्हाला आज कशी मदत करू शकेन?",
    chatbotPlaceholder: "मला काहीही विचारा...",
    send: "पाठवा",
    footerAbout: "आमच्या बद्दल",
    footerContact: "संपर्क साधा",
    footerPrivacy: "गोपनीयता धोरण",
    footerTerms: "सेवा अटी",
    footerConnect: "आमच्याशी कनेक्ट व्हा",
    allRightsReserved: "सर्व हक्क राखीव."
  }
};

let currentLang = 'en';

function setLanguage(lang) {
  if (!translations[lang]) {
    console.warn('No translations for', lang);
    return;
  }
  currentLang = lang;

  document.querySelectorAll('[data-translate]').forEach(el => {
    const key = el.getAttribute('data-translate');
    const value = translations[currentLang][key] ?? '';
    if (el.hasAttribute('data-translate-html')) {
      el.innerHTML = value;
    } else {
      el.textContent = value;
    }
  });

  // placeholder
  const userInput = document.getElementById('userInput');
  if (userInput) {
    userInput.placeholder = translations[currentLang]['chatbotPlaceholder'] ?? '';
  }

  // chatbot header (use innerHTML for icons/emojis)
  const chatbotHeader = document.querySelector('.chatbot-header');
  if (chatbotHeader) {
    chatbotHeader.innerHTML = translations[currentLang]['chatbotHeader'] ?? '';
  }

  // reset chatbot welcome message
  const chatBody = document.getElementById('chatBody');
  if (chatBody) {
    const headerShort = (translations[currentLang]['chatbotHeader'] || '').split(' ')[0] || '';
    chatBody.innerHTML = `<div><strong>${headerShort}</strong> ${translations[currentLang]['chatbotInitialBot'] || ''}</div>`;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  setLanguage(currentLang);
});
</script>



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
<button class="chatbot-btn" onclick="toggleChat()"></button>

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
      return "📅 You  can schedule a pickup using the 'Schedule Pickup' button.";
    } else if (msg.includes("emergency")) {
      return "🚨 Use the 'Emergency' button for immediate assistance.";
    } else if (msg.includes("map") || msg.includes("location")) {
      return "🗺️ The map shows current garbage vehicle locations.";
    } else if (msg.includes("cleaner") || msg.includes("clean")) {
      return "🧹 Click on 'Cleaner Man' to request a cleaner.";
    } else if (msg.includes("language") || msg.includes("marathi")) {
      return "you can change Language usinf launguage button";
    } else if (msg.includes("disposal")) {
      return "🧪 Use 'Special Disposal' for e-waste, medical, or chemical waste.";
    } else {
      return "🤖 I'm here to assist! Ask about pickup, services, emergencies, or the live map.";
    }
  }
</script>
<button class="chatbot-btn" onclick="toggleChat()" aria-label="Open Chatbot">
    <i class="fas fa-comments"></i>
</button>

<div class="chatbot-window" id="chatbotWindow" style="display:none;">
    <div class="chatbot-header">
        <span style="color: white;">Chatbot</span>
        <button class="close-btn" onclick="toggleChat()" aria-label="Close Chatbot">&times;</button>
    </div>
    <div class="chatbot-body" id="chatBody"></div>
    <div class="chatbot-input">
        <input type="text" id="userInput" data-translate="chatbotPlaceholder" 
               placeholder="Ask me anything..." 
               onkeypress="if(event.keyCode === 13) sendMessage()">
        <button onclick="sendMessage()" data-translate="send">Send</button>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
  <a class="navbar-brand" href="#">
    <i class="fas fa-recycle icon"></i> <span data-translate="brand" >SmartWaste</span>
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <div class="d-flex gap-2 mt-2 mt-lg-0 align-items-center">
    
      <!-- Home Button -->
      <a href="backup.php" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-home"></i> <span data-translate="home"></span>
      </a>

      <!-- Language Dropdown -->
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-success dropdown-toggle" id="languageDropdown" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="fas fa-globe"></i> <span data-translate="language"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
          <li><a class="dropdown-item" href="#" onclick="setLanguage('en')">English</a></li>
          <li><a class="dropdown-item" href="#" onclick="setLanguage('hi')">हिंदी</a></li>
          <li><a class="dropdown-item" href="#" onclick="setLanguage('mr')">मराठी</a></li>
        </ul>
      </div>

      <!-- Profile Dropdown -->
      <div class="dropdown">
        <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" id="settingsDropdown"
          data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-cog"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
          <li><a class="dropdown-item" href="myprofile.php">Profile</a></li>
           <li><a class="dropdown-item" href="yourschedule.php">Your Schedule</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item text-danger" href="createprofile.php">Logout</a></li>
        </ul>
      </div>

    </div>
  </div>
</nav>


<section class="hero container my-4 d-flex align-items-center justify-content-center">
   <div class="hero-slideshow" id="heroSlideshow">
  <div class="slide" style="background-image: url(photos/photo2.jpeg);"></div>
  <div class="slide" style="background-image: url(photos/photo1.jpeg);"></div>
  <div class="slide" style="background-image: url(photos/photo6.jpeg);"></div>
  <div class="slide" style="background-image: url('images/slide4.jpg');"></div>
  <div class="slide" style="background-image: url('images/slide5.jpg');"></div>
</div>

    <div class="content" data-aos="fade-up">
        <h1 class="display-5 fw-bold" data-translate="heroTitle">Let’s Clean Together!</h1>
        <p class="lead" data-translate="heroSubtitle">Book your next waste pickup in one click and make your city cleaner.</p>
        <a href="pickup.php" class="btn btn-success mt-3 btn-lg" data-translate="schedulePickup">📆 Schedule Pickup</a>
    </div>
</section>

<section class="container text-center my-5 py-4">
    <h3 class="mb-5 display-6 fw-bold text-primary-green" data-aos="fade-right" data-translate="quickActions">⚡ Quick Actions</h3>
    <div class="row g-4 justify-content-center">
        <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="card shadow-sm p-3">
                <img src="photos/photo4.jpeg" class="img-fluid mb-2" alt="Emergency Waste Disposal">
                <button class="btn btn-outline-danger w-100" data-translate="emergency" onclick="window.location.href='clener.php'">🚨 Emergency</button>
            </div>
        </div>
        <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="card shadow-sm p-3">
                <img src="photos/photo1.jpeg" class="img-fluid mb-2" alt="Request a Cleaner">
                <button class="btn btn-outline-primary w-100" data-translate="cleanerMan" onclick="window.location.href='clenerman.php'">🧹 Cleaner Man</button>
            </div>
        </div>
        <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="card shadow-sm p-3">
                <img src="photos/photo3.jpeg" class="img-fluid mb-2" alt="Special Waste Disposal">
                <button class="btn btn-outline-warning w-100" data-translate="specialDisposal"  onclick="window.location.href='dispol.php'">🧪 Special Disposal</button>  <!-- for button -->
            </div>
        </div>
        <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="card shadow-sm p-3">
                <img src="photos/photo5.jpeg" class="img-fluid mb-2" alt="Waste Collection Subscription">
                <button class="btn btn-outline-success w-100" data-translate="subscription" onclick="window.location.href='disopl.php'">📅 Subscription</button>
            </div>
        </div>
    </div>
</section>
<!-- Our Services Slider -->
<!-- Services Slider Section -->
<section class="container my-5 py-4" data-aos="fade-up">
  <h3 class="text-center mb-4 display-6 fw-bold text-primary-green">🌟 Our Services</h3>

  <div id="servicesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h4 class="text-xl fw-bold">3. Integrated Payment Gateway</h4>
            <p>Secure online payments for subscriptions and one-time services with support for multiple payment methods.</p>
          </div>
          <div class="col-md-6 text-center">
            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/dff5e7ca-ebe5-4700-8c1a-edc8955057ec.png" 
                 class="img-fluid rounded service-img" alt="Payment Gateway">
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h4 class="text-xl fw-bold">4. Real-Time Tracking</h4>
            <p>Track your service providers in real-time via GPS for waste collection and cleaning services.</p>
          </div>
          <div class="col-md-6 text-center">
            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b42773c9-09d8-48dd-9b8a-96bf01832b9d.png" 
                 class="img-fluid rounded service-img" alt="Real-Time Tracking">
          </div>
        </div>
      </div>

       <div class="carousel-item">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h4 class="text-xl fw-bold">5. Cleaner Man Service (Drain Cleaning)</h4>
            <p>Tailored cleaning for events, including setup, takedown, and waste management to keep venues pristine</p>
          </div>
          <div class="col-md-6 text-center">
            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/cce84449-2721-4470-80f5-9519dcb9b1ae.png"
                 class="img-fluid rounded service-img" alt="Cleaner Man Service">
          </div>
        </div>
      </div>

        <div class="carousel-item">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h4 class="text-xl fw-bold">6. Waste Segregation & Recycling Tips</h4>
        <p>Learn effective recycling techniques with interactive guides and community-shared tips for eco-living.</p>
          </div>
          <div class="col-md-6 text-center">
            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/bcd2766b-ea13-4f71-bf7d-b1799a6ec219.png"
                 class="img-fluid rounded service-img" alt="Waste Segregation & Recycling Tips">
          </div>
        </div>
      </div>

       <div class="carousel-item">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h4 class="text-xl fw-bold">1.  Event Cleaning Services</h4>
        <p>Tailored cleaning for events, including setup, takedown, and waste management to keep venues pristine.</p>
          </div>
          <div class="col-md-6 text-center">
            <img src="photos\photo55.png"
                 class="img-fluid rounded service-img" alt="Event Cleanings">
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h4 class="text-xl fw-bold">1.  Event Cleaning Services</h4>
        <p>Tailored cleaning for events, including setup, takedown, and waste management to keep venues pristine.</p>
          </div>
          <div class="col-md-6 text-center">
            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/cce84449-2721-4470-80f5-9519dcb9b1ae.png"
                 class="img-fluid rounded service-img" alt="Event Cleanings">
          </div>
        </div>
      </div>

      <!-- Repeat the same structure for all other 17 services (Slides 3 → 19) -->

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</section>

<!-- CSS to control image size -->
<style>
  .service-img {
    max-height: 350px;  /* Adjust height */
    width: auto;        /* Keep aspect ratio */
  }
</style>

<section class="container my-5 py-4" data-aos="fade-up">
    <h3 class="text-center mb-4 display-6 fw-bold text-primary-green" data-translate="liveMapTitle">🗺️ Live City Map - Rajgurunagar Taluka</h3>
    <div id="map" class="map-container">
        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDJLb_10WP7sVy0xjOwgnq7nVr1PMGAXp0&q=Rajgurunagar,Maharashtra,India&zoom=14" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <p class="text-center mt-3 text-muted" data-translate="mapDescription" style="color:white">🔍 Tracking live location of Ghantagadi vehicles in Rajgurunagar.</p>
</section>

<footer class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="text-white mb-3" data-translate="brand">♻️ CleanCity360<sup>0<sup></h5>
                <p class="text-muted">Innovating waste management for a cleaner, greener future.</p>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="text-white mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="resume.html" data-translate="footerAbout">About Us</a></li>
                    <li><a href="#" data-translate="footerContact">Contact</a></li>
                    <li><a href="#" data-translate="footerPrivacy">Privacy Policy</a></li>
                    <li><a href="#" data-translate="footerTerms">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="text-white mb-3" data-translate="footerConnect">Connect With Us</h5>
                <div class="social-icons">
                    <a href="#" class="text-white"><i class="fas fa-map-marker-alt"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <p class="mb-0 text-muted">&copy; <?php echo date("Y"); ?> SmartWaste. <span data-translate="allRightsReserved">All rights reserved.</span></p>
    </div>
</footer>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000 });

  function initMap() {
    const rajgurunagar = { lat: 18.866, lng: 73.889 };

    // Initialize map
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 14,
      center: rajgurunagar,
      mapTypeId: "roadmap"
    });

    // Markers
    const markers = [
      { lat: 18.867, lng: 73.890, title: "🧹 Garbage Collection Center" },
      { lat: 18.869, lng: 73.887, title: "♻️ RecycleMart Pvt. Ltd." },
      { lat: 18.865, lng: 73.892, title: "🧴 E-Waste Drop Zone" },
      { lat: 18.864, lng: 73.894, title: "🌱 Compost Facility" },
      { lat: 18.866, lng: 73.889, title: "🚌 Rajgurunagar Bus Station" }
    ];

    markers.forEach(loc => {
      new google.maps.Marker({
        position: { lat: loc.lat, lng: loc.lng },
        map,
        title: loc.title,
        icon: "https://maps.google.com/mapfiles/ms/icons/green-dot.png"
      });
    });

    // Highlight main road (yellow)
    const mainRoadCoords = [
      { lat: 18.872, lng: 73.885 },
      { lat: 18.870, lng: 73.887 },
      { lat: 18.868, lng: 73.889 },
      { lat: 18.866, lng: 73.889 },
      { lat: 18.864, lng: 73.890 },
      { lat: 18.862, lng: 73.892 }
    ];

    new google.maps.Polyline({
      path: mainRoadCoords,
      geodesic: true,
      strokeColor: "#FFD700", // Yellow
      strokeOpacity: 1.0,
      strokeWeight: 6,
      map: map
    });

    // Rajgurunagar Bus Station → Manchar Road (Orange)
    const mancharRoadCoords = [
      { lat: 18.866, lng: 73.889 }, // Rajgurunagar Bus Station
      { lat: 18.870, lng: 73.875 }, // approximate route
      { lat: 18.875, lng: 73.860 }  // Manchar Road
    ];

    new google.maps.Polyline({
      path: mancharRoadCoords,
      geodesic: true,
      strokeColor: "#FF8C00", // Orange
      strokeOpacity: 0.9,
      strokeWeight: 6,
      map: map
    });

    // Rajgurunagar Bus Station → Pune Road (Red)
    const puneRoadCoords = [
      { lat: 18.866, lng: 73.889 }, // Rajgurunagar Bus Station
      { lat: 18.860, lng: 73.895 }, // approximate route
      { lat: 18.855, lng: 73.900 }  // Pune Road
    ];

    new google.maps.Polyline({
      path: puneRoadCoords,
      geodesic: true,
      strokeColor: "#FF0000", // Red
      strokeOpacity: 0.9,
      strokeWeight: 6,
      map: map
    });
  }
</script>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJLb_10WP7sVy0xjOwgnq7nVr1PMGAXp0&callback=initMap" async defer></script>

</body>
</html> >