<script setup>
import { Head, router } from "@inertiajs/vue3"
import { ref, watch } from "vue"
import AdminSidebar from "../Components/AdminSidebar.vue"

const props = defineProps({
  steps: Object,
  filters: Object
})

const search = ref(props.filters.search || "")

watch(search, (value) => {
  router.get('/admin/steps', { search: value }, {
    preserveState: true,
    replace: true
  })
})
</script>

<template>
  <div class="admin-layout">

    <Head title="Step Tracking" />
    <AdminSidebar />

    <main class="main-content">
      <header class="page-header">
        <div class="header-title">
          <h1>Step Management</h1>
          <p>Monitor progress of active idea steps</p>
        </div>
        <div class="header-stats">
          <div class="stat-card">
            <div class="stat-icon steps">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
              </svg>
            </div>
            <div class="stat-info">
              <span class="stat-label">Active Steps</span>
              <span class="stat-value">{{ steps.total }}</span>
            </div>
          </div>
        </div>
      </header>

      <div class="table-tools">
        <input v-model="search" type="text" placeholder="Search steps or ideas..." class="search-input" />
      </div>
      <div class="table-card">
        <table class="modern-table">
          <thead>
            <tr>
              <th>Linked Idea</th>
              <th>Description</th>
              <th>Progress</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="step in steps.data" :key="step.id">
              <td><strong>{{ step.idea?.title || 'No Idea' }}</strong></td>
              <td class="desc-text">{{ step.description }}</td>
              <td>
                <span :class="step.completed ? 'badge-success' : 'badge-warning'" class="status-badge">
                  {{ step.completed ? 'Completed' : 'Pending' }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="pagination">
          <button v-for="link in steps.links" :key="link.label" v-html="link.label" :disabled="!link.url"
            @click="router.get(link.url)" class="page-btn"></button>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
/* Layout & Content */
.admin-layout {
  display: flex;
  background: #f8fafc;
  min-height: 100vh;
  font-family: 'Inter', sans-serif;
}

.main-content {
  flex: 1;
  margin-left: 260px;
  padding: 40px;
}

/* Header & Stat Cards */
.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
}

.header-title h1 {
  font-size: 24px;
  font-weight: 800;
  color: #0f172a;
  margin: 0;
}

.header-title p {
  color: #64748b;
  font-size: 14px;
  margin-top: 4px;
}

.stat-card {
  background: white;
  padding: 16px 24px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  gap: 16px;
  border: 1px solid #f1f5f9;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}

.stat-icon {
  padding: 10px;
  border-radius: 12px;
}

.stat-icon.users {
  background: #eef2ff;
  color: #6366f1;
}

.stat-icon.ideas {
  background: #f0fdf4;
  color: #22c55e;
}

.stat-icon.steps {
  background: #fff7ed;
  color: #f59e0b;
}

.stat-label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: #94a3b8;
  text-transform: uppercase;
}

.stat-value {
  font-size: 20px;
  font-weight: 800;
  color: #0f172a;
}

/* Table Styling */
.table-card {
  background: white;
  border-radius: 20px;
  border: 1px solid #f1f5f9;
  overflow: hidden;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
}

.modern-table {
  width: 100%;
  border-collapse: collapse;
}

.modern-table th {
  background: #f8fafc;
  padding: 16px 24px;
  text-align: left;
  font-size: 12px;
  font-weight: 700;
  color: #64748b;
  text-transform: uppercase;
  border-bottom: 1px solid #f1f5f9;
}

.modern-table td {
  padding: 18px 24px;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
  color: #334155;
  font-size: 14px;
}

.modern-table tr:hover {
  background: #fcfdfe;
}

/* Components: Avatars, Pills, Badges */
.user-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.avatar {
  width: 38px;
  height: 38px;
  background: #6366f1;
  color: white;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
}

.avatar.sm {
  width: 30px;
  height: 30px;
  border-radius: 8px;
  font-size: 12px;
}

.user-name {
  font-weight: 700;
  color: #0f172a;
  display: block;
}

.user-id {
  font-size: 11px;
  color: #94a3b8;
}

.status-badge {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
}

.badge-success,
.status-badge.completed {
  background: #f0fdf4;
  color: #16a34a;
}

.badge-warning,
.status-badge.pending {
  background: #fff7ed;
  color: #d97706;
}

.idea-pill {
  background: #f1f5f9;
  border: 1px solid #e2e8f0;
  padding: 2px 10px;
  border-radius: 6px;
  font-size: 12px;
}

.thumb {
  width: 44px;
  height: 44px;
  border-radius: 8px;
  object-fit: cover;
  border: 1px solid #e2e8f0;
}

.no-data {
  color: #cbd5e1;
  font-style: italic;
  font-size: 13px;
}

@media (max-width: 1024px) {
  .main-content {
    margin-left: 0;
    padding: 20px;
  }
}

.table-tools {
  padding: 20px;
  border-bottom: 1px solid #f1f5f9;
}

.search-input {
  width: 320px;
  padding: 8px 12px;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
}

.pagination {
  display: flex;
  gap: 6px;
  padding: 20px;
}

.page-btn {
  padding: 6px 12px;
  border: 1px solid #e2e8f0;
  background: white;
  border-radius: 6px;
  cursor: pointer;
}

.page-btn:hover {
  background: #f1f5f9;
}
</style>