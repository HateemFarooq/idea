<script setup>
import { Head } from "@inertiajs/vue3"
import FlashMessage from "../Components/FlashMessage.vue"
import AdminSidebar from "../Components/AdminSidebar.vue"
</script>

<template>
  <Head title="Dashboard" />
  <div class="layout">
    <AdminSidebar />
    <main class="content">
      <header class="top-header">
        <div class="breadcrumb">
          <span class="root">Overview</span>
          <span class="separator">/</span>
          <span class="current">Dashboard</span>
        </div>
        
        <div class="user-profile">
          <div class="text-info">
            <span class="user-name">Admin User</span>
            <span class="status-badge">Online</span>
          </div>
          <div class="avatar-wrapper">
            <div class="avatar"></div>
            <div class="online-indicator"></div>
          </div>
        </div>
      </header>

      <div class="dashboard-body">
        <FlashMessage />
        
        <div class="welcome-card">
          <div class="welcome-text">
            <h1>Welcome Back, Admin! 👋</h1>
            
          </div>
          
        </div>

        <div class="stats-grid-placeholder">
           </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
.layout { display: flex; background: #f8fafc; min-height: 100vh; }
.content { flex-grow: 1; margin-left: 260px; transition: 0.3s; }

.top-header {
  background: white;
  height: 80px;
  padding: 0 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #f1f5f9;
  position: sticky;
  top: 0;
  z-index: 10;
}

.breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; }
.breadcrumb .root { color: #94a3b8; }
.breadcrumb .separator { color: #cbd5e1; }
.breadcrumb .current { color: #0f172a; }

.user-profile { display: flex; align-items: center; gap: 16px; }
.text-info { text-align: right; }
.user-name { display: block; font-size: 14px; font-weight: 700; color: #1e293b; }
.status-badge { 
  font-size: 11px; 
  font-weight: 700; 
  color: #10b981; 
  background: #ecfdf5; 
  padding: 2px 8px; 
  border-radius: 20px;
  text-transform: uppercase;
}

.avatar-wrapper { position: relative; }
.avatar { 
  width: 42px; 
  height: 42px; 
  background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); 
  border-radius: 14px; 
  border: 2px solid white;
  box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
}
.online-indicator {
  position: absolute;
  bottom: -2px;
  right: -2px;
  width: 12px;
  height: 12px;
  background: #10b981;
  border: 2px solid white;
  border-radius: 50%;
}

.dashboard-body { padding: 40px; max-width: 1200px; margin: 0 auto; width: 100%; }

.welcome-card {
  background: white;
  padding: 32px;
  border-radius: 24px;
  border: 1px solid #f1f5f9;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

h1 { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 8px; letter-spacing: -0.5px; }
p { color: #64748b; font-size: 16px; }

.btn-outline {
  padding: 10px 20px;
  background: white;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  font-weight: 600;
  font-size: 14px;
  color: #475569;
  cursor: pointer;
  transition: 0.2s;
}

.btn-outline:hover { background: #f8fafc; border-color: #cbd5e1; color: #0f172a; }

@media (max-width: 1024px) {
  .content { margin-left: 0; }
  .sidebar { transform: translateX(-100%); } /* You'd need a toggle for mobile */
}
</style>