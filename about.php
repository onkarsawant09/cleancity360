<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Smart Waste — Project</title>
  <style>
    :root{
      --accent:#0b6b4f;
      --muted:#6b6b6b;
      --card-bg:#ffffff;
      --bg:#f5f7fb;
      --maxw:1100px;
      --radius:12px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    body{
      margin:0;
      background:linear-gradient(180deg,#fbfeff,var(--bg));
      color:#111827;
      padding:28px 14px;
    }
    .wrap{max-width:var(--maxw);margin:0 auto;}
    header{
      display:flex;
      gap:18px;
      align-items:center;
      margin-bottom:18px;
    }
    .logo{
      width:100px;height:100px;border-radius:14px;
      background:linear-gradient(135deg,var(--accent),#0b84a5);
      color:white;display:flex;align-items:center;justify-content:center;
      font-weight:700;font-size:16px;box-shadow:0 10px 30px rgba(11,107,79,0.12);
      text-align:center;
    }
    h1{margin:0;font-size:30px;}
    .byline{color:var(--muted);margin-top:6px;font-size:15px;}
    .grid{
      display:grid;
      grid-template-columns: 1fr 340px;
      gap:20px;
      align-items:start;
    }
    @media (max-width:900px){ .grid{grid-template-columns:1fr} .aside{order:2} }
    .card{background:var(--card-bg);border-radius:var(--radius);padding:20px;box-shadow:0 6px 20px rgba(15,23,42,0.06);}
    .hero{display:flex;gap:16px;align-items:center;}
    .hero img{width:300px;height:200px;object-fit:cover;border-radius:12px;flex-shrink:0;}
    section h2{margin-top:10px;margin-bottom:8px;color:var(--accent);}
    p{line-height:1.6;color:#1f2937}
    ul.points{margin:10px 0 14px 20px}
    ul.points li{margin-bottom:8px;display:flex;align-items:center;gap:10px}
    ul.points img{width:32px;height:32px;border-radius:6px;object-fit:cover;flex-shrink:0}
    .stat-row{display:flex;gap:12px;flex-wrap:wrap;margin-top:12px}
    .stat{background:#f3fbf7;border-radius:10px;padding:12px 16px;font-weight:600;color:var(--accent);font-size:14px}
    .cta{display:inline-block;margin-top:12px;padding:12px 16px;border-radius:10px;background:var(--accent);color:#fff;text-decoration:none}
    .aside .card + .card{margin-top:12px}
    footer{margin-top:22px;text-align:center;color:var(--muted);font-size:14px}
    .photo-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:12px}
    .photo-grid img{width:100%;height:180px;object-fit:cover;border-radius:10px}
    .small{font-size:13px;color:var(--muted)}
    .method-list{display:grid;gap:10px;margin-top:10px}
    .method-item{padding:12px;border-radius:8px;background:#fcfffb;border:1px solid #eef8f1}
    code{background:#f6f8fb;padding:4px 6px;border-radius:6px;font-size:13px}
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <div class="logo">SMART<br>WASTE</div>
      <div>
        <h1>SMART WASTE — A Waste Management System</h1>
        <div class="byline">Project by Omkar Sawant &amp; Sarang Shinde</div>
      </div>
    </header>

    <div class="grid">
      <!-- main column -->
      <main>
        <!-- Intro -->
        <article class="card hero">
          <div>
            <h2>Introduction</h2>
            <p>
              Smart Waste is a project created out of concern about environmental issues arising
              from poor waste management. It is a compact, technology-driven solution that helps
              cities and citizens manage waste better and maintain a healthier environment.
            </p>
            <div class="stat-row">
              <div class="stat">Reduce pollution</div>
              <div class="stat">Timely collection</div>
              <div class="stat">Citizen-friendly</div>
            </div>
          </div>
          <img src="https://source.unsplash.com/700x500/?smart-city,green" alt="Smart city">
        </article>

        <!-- Problem -->
        <section class="card" style="margin-top:14px">
          <h2>The Problem</h2>
          <p>
            Poor waste management increases health risks and environmental pollution. Problems linked
            with unmanaged waste include respiratory diseases, water-borne illnesses, and contamination.
          </p>
          <ul class="points">
            <li><img src="https://source.unsplash.com/60x60/?garbage,street" alt=""> Piled-up garbage due to missed or unpredictable collection timings</li>
            <li><img src="https://source.unsplash.com/60x60/?awareness,citizens" alt=""> Lack of awareness and discipline among citizens</li>
            <li><img src="https://source.unsplash.com/60x60/?government,office" alt=""> Institutional mismatches between governing bodies and ground operations</li>
            <li><img src="https://source.unsplash.com/60x60/?mosquito,disease" alt=""> Increased risk of vector-borne and water-borne diseases</li>
          </ul>
        </section>

        <!-- Goals -->
        <section class="card" style="margin-top:14px">
          <h2>Intentions (Goals)</h2>
          <p>
            The core intention of Smart Waste is to provide a technologically convenient platform that:
          </p>
          <ul class="points">
            <li><img src="https://source.unsplash.com/60x60/?gps,map" alt=""> Helps citizens know exact pickup schedules and vehicle locations</li>
            <li><img src="https://source.unsplash.com/60x60/?pollution,smog" alt=""> Reduces waste piles and environmental pollution</li>
            <li><img src="https://source.unsplash.com/60x60/?teamwork,workers" alt=""> Creates a bridge between workers and citizens</li>
            <li><img src="https://source.unsplash.com/60x60/?employment,job" alt=""> Generates employment through organized services</li>
          </ul>
          <a class="cta" href="#methodology">How it works</a>
        </section>

        <!-- Invention -->
        <section class="card" id="invention" style="margin-top:14px">
          <h2>Invention (What we built)</h2>
          <p>
            Smart Waste is a digital platform with features that include:
          </p>
          <ul class="points">
            <li><img src="https://source.unsplash.com/60x60/?gps,tracking" alt=""> Live tracking of garbage collection vehicles</li>
            <li><img src="https://source.unsplash.com/60x60/?calendar,time" alt=""> Detailed, predictable pickup schedules & delay notifications</li>
            <li><img src="https://source.unsplash.com/60x60/?hospital,building" alt=""> Interfaces for households, hospitals, hotels & institutions</li>
            <li><img src="https://source.unsplash.com/60x60/?dashboard,analytics" alt=""> Admin dashboard for monitoring & reporting</li>
          </ul>

          <div class="photo-grid">
         <img src="https://images.unsplash.com/photo-1600000000000-111111111111?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="garbage truck">
<img src="https://images.unsplash.com/photo-1600000000000-222222222222?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="recycling bins">
<img src="https://images.unsplash.com/photo-1600000000000-333333333333?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="clean city">
<img src="https://images.unsplash.com/photo-1600000000000-444444444444?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="community cleanup">

          </div>
        </section>

        <!-- Methodology -->
        <section class="card" id="methodology" style="margin-top:14px">
          <h2>Methodology</h2>
          <p>
            The project was implemented using standard web technologies and tools:
          </p>
          <div class="method-list">
            <div class="method-item"><strong>Frontend:</strong> HTML, CSS, JavaScript</div>
            <div class="method-item"><strong>Backend:</strong> PHP</div>
            <div class="method-item"><strong>Development tools:</strong> VS Code</div>
            <div class="method-item"><strong>AI / Research:</strong> ChatGPT, Google Search</div>
          </div>
          <p style="margin-top:10px"><strong>Quick tech snippet:</strong></p>
          <pre style="background:#f8fbff;padding:10px;border-radius:8px"><code>// Example (pseudo)
{
  "vehicle_id": "G-102",
  "route": "Sector 5 -> Market -> Hospital",
  "estimated_arrival": "2025-10-04T09:15:00+05:30",
  "status": "On route",
  "delay_minutes": 6
}</code></pre>
        </section>

        <!-- Impact -->
        <section class="card" style="margin-top:14px">
          <h2>Real-Life Impact</h2>
          <p>
            Implementation of Smart Waste can reduce overflowing garbage in public spaces, improve
            air quality, and encourage citizens to actively participate in keeping cities clean. 
            Municipal bodies can monitor efficiency, while workers get better schedules and support.
          </p>
          <ul class="points">
            <li><img src="https://source.unsplash.com/60x60/?health,wellbeing" alt=""> Better health outcomes by reducing disease spread</li>
            <li><img src="https://source.unsplash.com/60x60/?environment,green" alt=""> Cleaner and greener environment</li>
            <li><img src="https://source.unsplash.com/60x60/?community,people" alt=""> Stronger citizen engagement in cleanliness drives</li>
          </ul>
        </section>

        <!-- Future Scope -->
        <section class="card" style="margin-top:14px">
          <h2>Future Scope</h2>
          <p>
            Smart Waste has potential to expand further:
          </p>
          <ul class="points">
            <li><img src="https://source.unsplash.com/60x60/?ai,robot" alt=""> AI-powered predictive collection routes</li>
            <li><img src="https://source.unsplash.com/60x60/?iot,sensor" alt=""> IoT-enabled smart bins with fill-level alerts</li>
            <li><img src="https://source.unsplash.com/60x60/?renewable,energy" alt=""> Energy recovery from organic waste</li>
          </ul>
        </section>

        <!-- Fact -->
        <section class="card" style="margin-top:14px">
          <h2>Interesting Fact</h2>
          <p>
            Scientists discovered that mealworms can digest certain plastics — an exciting finding that
            could contribute to solutions for plastic pollution in the long run.
          </p>
          <img src="https://source.unsplash.com/900x400/?plastic,recycle" alt="plastic recycling" style="margin-top:8px;border-radius:10px;width:100%;height:260px;object-fit:cover">
        </section>

        <!-- Conclusion -->
        <section class="card" style="margin-top:14px">
          <h2>Conclusion</h2>
          <p>
            Smart Waste is more than just a project — it is a step toward cleaner, smarter, and healthier cities. 
            By merging technology with civic responsibility, it empowers citizens, supports municipal workers, 
            and safeguards the environment for future generations.
          </p>
        </section>

        <footer>
          <div class="small">Thank you — Smart Waste team</div>
        </footer>
      </main>

      <!-- Sidebar -->
      <aside class="aside">
        <div class="card">
          <h3>Project Snapshot</h3>
          <p class="small">
            A compact waste-management platform to connect citizens, cleaning workers, and municipal
            services — increasing efficiency, transparency and cleanliness.
          </p>
          <ul class="points">
            <li><img src="https://source.unsplash.com/40x40/?project,plan" alt=""> Type: Civic tech / Environmental</li>
            <li><img src="https://source.unsplash.com/40x40/?family,home" alt=""> Users: Households, institutions, municipal workers</li>
            <li><img src="https://source.unsplash.com/40x40/?tools,gear" alt=""> Core features: Tracking, scheduling, reporting</li>
          </ul>
        </div>

        <div class="card" style="margin-top:12px">
          <h3>Quick Action</h3>
          <p class="small">Want this page as editable HTML file or styled with Bootstrap instead?</p>
          <a class="cta" href="#" onclick="alert('Save this page as index.html in your editor')">Export HTML</a>
        </div>
      </aside>
    </div>
  </div>
</body>
</html>
