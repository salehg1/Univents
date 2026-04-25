<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Univents — Demo Portal</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      height: 100%;
      background: #070b17;
      font-family: 'JetBrains Mono', 'Fira Mono', monospace;
      color: #e2e8f0;
      overflow: hidden;
    }

    .portal-bar {
      height: 52px;
      background: #0d1526;
      border-bottom: 1px solid rgba(255,255,255,0.08);
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 0 20px;
      flex-shrink: 0;
    }

    .portal-brand {
      display: flex;
      flex-direction: column;
      line-height: 1.2;
      flex-shrink: 0;
    }
    .portal-name {
      font-size: 0.85rem;
      color: #06b6d4;
      font-weight: 600;
      letter-spacing: 0.05em;
    }
    .portal-sub {
      font-size: 0.62rem;
      color: #334155;
    }

    .divider {
      width: 1px;
      height: 24px;
      background: rgba(255,255,255,0.08);
      flex-shrink: 0;
    }

    .view-label {
      font-size: 0.68rem;
      color: #475569;
      flex-shrink: 0;
    }

    .role-btns {
      display: flex;
      gap: 6px;
    }

    .role-btn {
      background: transparent;
      border: 1px solid rgba(6,182,212,0.25);
      color: #64748b;
      padding: 5px 14px;
      border-radius: 6px;
      font-family: inherit;
      font-size: 0.72rem;
      cursor: pointer;
      transition: all 0.18s;
      white-space: nowrap;
    }
    .role-btn:hover {
      border-color: rgba(6,182,212,0.6);
      color: #cbd5e1;
    }
    .role-btn.active {
      background: rgba(6,182,212,0.15);
      border-color: #06b6d4;
      color: #06b6d4;
    }

    .loading-indicator {
      font-size: 0.65rem;
      color: #334155;
      margin-left: 4px;
      opacity: 0;
      transition: opacity 0.2s;
    }
    .loading-indicator.visible { opacity: 1; }

    .back-link {
      margin-left: auto;
      font-size: 0.72rem;
      color: #94a3b8;
      text-decoration: none;
      flex-shrink: 0;
      border: 1px solid rgba(148,163,184,0.3);
      padding: 5px 12px;
      border-radius: 6px;
      transition: all 0.18s;
    }
    .back-link:hover {
      color: #06b6d4;
      border-color: #06b6d4;
      background: rgba(6,182,212,0.08);
    }

    #demo-frame {
      display: block;
      width: 100%;
      height: calc(100vh - 52px);
      border: none;
    }
  </style>
</head>
<body>

<div class="portal-bar">
  <div class="portal-brand">
    <span class="portal-name">Univents</span>
    <span class="portal-sub">// event management platform</span>
  </div>

  <div class="divider"></div>

  <span class="view-label">view as:</span>

  <div class="role-btns">
    <button class="role-btn active" data-role="visitor" data-page="HomePage/Visitors/Homepage.php">
      // visitor
    </button>
    <button class="role-btn" data-role="student" data-page="HomePage/Student/StudentHomepage.php">
      // student
    </button>
    <button class="role-btn" data-role="admin" data-page="HomePage/Admin/admin.php">
      // admin
    </button>
  </div>

  <span class="loading-indicator" id="loader">loading…</span>

  <a href="/portfolio/projects.html" class="back-link">← portfolio</a>
</div>

<iframe id="demo-frame" src="HomePage/Visitors/Homepage.php"></iframe>

<script>
  const frame  = document.getElementById('demo-frame');
  const btns   = document.querySelectorAll('.role-btn');
  const loader = document.getElementById('loader');

  btns.forEach(btn => {
    btn.addEventListener('click', async () => {
      if (btn.classList.contains('active')) return;

      btns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      loader.classList.add('visible');

      await fetch('demo-auth.php?role=' + btn.dataset.role);

      frame.src = btn.dataset.page;
      frame.onload = () => loader.classList.remove('visible');
    });
  });
</script>

</body>
</html>
