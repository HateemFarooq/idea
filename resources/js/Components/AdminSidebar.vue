<script setup>
import { router, Link, usePage } from "@inertiajs/vue3"

const page = usePage()

function logout(){
    router.post('/admin/logout')
}
</script>

<template>
  <div class="sidebar">
    <div class="brand">
      <div class="logo-box">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
        </svg>
      </div>
      <span class="brand-text">Admin<span class="text-indigo">Core</span></span>
    </div>

    <div class="nav-section">
      <span class="label">CORE</span>
      <ul class="menu">
        <li>
          <Link href="/admin/dashboard" :class="{ active: page.url === '/admin/dashboard' }">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Dashboard
          </Link>
        </li>
      </ul>

      <span class="label">RESOURCES</span>
      <ul class="menu">
        <li>
          <Link href="/admin/users" :class="{ active: page.url.startsWith('/admin/users') }">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            Users
          </Link>
        </li>
        <li>
          <Link href="/admin/ideas" :class="{ active: page.url.startsWith('/admin/ideas') }">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 weight=24 24 24 24"/><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            Ideas
          </Link>
        </li>
        <li>
          <Link href="/admin/steps" :class="{ active: page.url.startsWith('/admin/steps') }">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
            Steps
          </Link>
        </li>
      </ul>
    </div>

    <div class="footer-nav">
      <button class="logout-btn" @click="logout">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4m7 14l5-5-5-5m5 5H9"/>
        </svg>
        <span>Logout Session</span>
      </button>
    </div>
  </div>
</template>

<style scoped>
.sidebar {
  width: 260px;
  height: 100vh;
  background: #0f172a; /* Deep Slate */
  color: white;
  position: fixed;
  display: flex;
  flex-direction: column;
  border-right: 1px solid rgba(255,255,255,0.05);
}

.brand {
  padding: 32px 24px;
  font-size: 18px;
  font-weight: 800;
  display: flex;
  align-items: center;
  gap: 12px;
  letter-spacing: -0.5px;
}

.brand-text { color: #f8fafc; }
.text-indigo { color: #6366f1; }

.logo-box {
  background: #6366f1;
  padding: 8px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

.nav-section { flex-grow: 1; padding: 0 16px; }

.label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  color: #475569;
  letter-spacing: 1.5px;
  margin: 30px 0 12px 12px;
}

.menu { list-style: none; padding: 0; }
.menu li { margin-bottom: 6px; }

.menu a {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  color: #94a3b8;
  text-decoration: none;
  border-radius: 12px;
  font-weight: 600;
  font-size: 14px;
  transition: all 0.2s ease;
}

.menu a:hover {
  background: rgba(255, 255, 255, 0.05);
  color: #f8fafc;
}

.menu a.active {
  background: #6366f1;
  color: white;
  box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
}

.footer-nav { padding: 24px 16px; border-top: 1px solid rgba(255,255,255,0.05); }

.logout-btn {
  width: 100%;
  display: flex;
  align-items: center;
  gap: 10px;
  background: transparent;
  border: 1px solid #1e293b;
  color: #94a3b8;
  padding: 12px 16px;
  border-radius: 12px;
  cursor: pointer;
  font-weight: 600;
  font-size: 14px;
  transition: all 0.2s;
}

.logout-btn:hover {
  background: #ef4444;
  color: white;
  border-color: #ef4444;
}
</style>