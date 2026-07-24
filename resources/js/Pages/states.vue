<script setup>
import { ref, watch } from "vue"
import { Head, router, Link } from "@inertiajs/vue3"
import AdminSidebar from "../Components/AdminSidebar.vue"
import FlashMessage from "../Components/FlashMessage.vue"

const props = defineProps({
  states: Object,    
  filters: {
    type: Object,
    default: () => ({ search: '' })
  }
})

const search = ref(props.filters.search || '')

watch(search, (value) => {
  router.get('/admin/states', { search: value }, { preserveState: true, replace: true })
})

const showModal = ref(false)
const selectedId = ref(null)

function openModal(id) {
  selectedId.value = id
  showModal.value = true
}

function closeModal() {
  showModal.value = false
}

function deleteState() {
  router.delete(`/admin/states/${selectedId.value}`, {
    onSuccess: () => {
      closeModal()
    }
  })
}
</script>

<template>
  <div class="admin-layout">
    <Head title="States" />
    <AdminSidebar />

    <main class="main-content">
      <header class="page-header">
        <div class="header-title">
          <h1>State Management</h1>
          <p>Organize and moderate states and provinces.</p>
        </div>

        <div class="header-stats">
          <FlashMessage />
          <div class="stat-card">
            <div class="stat-icon states">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
            <div class="stat-info">
              <span class="stat-label">Total States</span>
              <span class="stat-value">{{ states.total }}</span>
            </div>
          </div>
        </div>
      </header>

      <div class="table-tools">
        <div class="tools-flex">
          <input 
            v-model="search" 
            type="text" 
            placeholder="Search state or country..." 
            class="search-input" 
          />
          <Link href="/admin/states/create" class="add-btn-modern">
            <span class="plus-icon">+</span> Create State
          </Link>
        </div>
      </div>

      <div class="table-card">
        <div class="table-responsive">
          <table class="modern-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Country</th>
                <th>State Name</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="state in states.data" :key="state.id">
                <td class="id-col">
                  <span class="id-badge">#{{ state.id }}</span>
                </td>

                <td>
                  <div class="country-pill">
                    {{ state.country?.name || 'Global' }}
                  </div>
                </td>

                <td class="name-col">
                  <span class="state-name-text">{{ state.name }}</span>
                </td>

                <td class="actions-col">
                  <div class="action-group">
                    <Link :href="`/admin/states/${state.id}/edit`" class="view-btn" title="Edit">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </Link>

                    <button class="delete-btn-modern" @click="openModal(state.id)" title="Delete">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="!states.data.length">
                <td colspan="4" class="empty-row">No states found.</td>
              </tr>
            </tbody>
          </table>

          <div class="pagination">
            <button 
              v-for="link in states.links" 
              :key="link.label" 
              v-html="link.label" 
              :disabled="!link.url"
              @click="router.get(link.url)" 
              class="page-btn"
              :class="{'active': link.active}"
            ></button>
          </div>
        </div>
      </div>

      <div v-if="showModal" class="modal-overlay">
        <div class="modal-box">
          <div class="modal-icon">📍</div>
          <h3>Delete State</h3>
          <p>Removing this state might affect linked cities. Proceed?</p>

          <div class="modal-actions">
            <button class="cancel-btn" @click="closeModal">Cancel</button>
            <button class="confirm-btn" @click="deleteState">Delete</button>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
/* Layout Styles */
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

/* Header & Stats */
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
  letter-spacing: -0.02em;
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

.stat-icon.states {
  background: #eef2ff;
  color: #6366f1;
  padding: 10px;
  border-radius: 12px;
}

.stat-label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  color: #94a3b8;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.stat-value {
  font-size: 20px;
  font-weight: 800;
  color: #0f172a;
}

/* Tools Bar */
.tools-flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.search-input {
  width: 320px;
  padding: 12px 16px;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  font-size: 14px;
  background: white;
  transition: all 0.2s;
}

.search-input:focus {
  outline: none;
  border-color: #6366f1;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.add-btn-modern {
  background: #0f172a;
  color: white;
  padding: 12px 20px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: 0.2s;
}

.add-btn-modern:hover {
  background: #1e293b;
  transform: translateY(-1px);
}

/* Table Card */
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
  font-size: 11px;
  font-weight: 700;
  color: #64748b;
  text-transform: uppercase;
  border-bottom: 1px solid #f1f5f9;
}

.modern-table td {
  padding: 16px 24px;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
}

.id-badge {
  background: #f1f5f9;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 12px;
  font-weight: 600;
  color: #64748b;
}

.country-pill {
  background: #f0fdf4;
  color: #16a34a;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 700;
  display: inline-block;
}

.state-name-text {
  font-weight: 600;
  color: #0f172a;
}

/* Actions */
.action-group {
  display: flex;
  gap: 8px;
  justify-content: flex-end;
}

.view-btn, .delete-btn-modern {
  padding: 8px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  background: #f8fafc;
  color: #64748b;
  transition: 0.2s;
}

.view-btn:hover { background: #eef2ff; color: #6366f1; }
.delete-btn-modern:hover { background: #fef2f2; color: #ef4444; }

/* Pagination */
.pagination {
  display: flex;
  gap: 6px;
  padding: 20px;
  background: #f8fafc;
}

.page-btn {
  padding: 8px 14px;
  border: 1px solid #e2e8f0;
  background: white;
  border-radius: 10px;
  cursor: pointer;
  font-size: 13px;
  color: #64748b;
}

.page-btn.active {
  background: #6366f1;
  color: white;
  border-color: #6366f1;
}

/* Modal */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(15, 23, 42, 0.6);
  backdrop-filter: blur(4px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 100;
}

.modal-box {
  background: white;
  padding: 32px;
  border-radius: 24px;
  width: 360px;
  text-align: center;
}

.modal-actions {
  display: flex;
  gap: 12px;
  margin-top: 24px;
}

.cancel-btn, .confirm-btn {
  flex: 1;
  padding: 12px;
  border-radius: 12px;
  font-weight: 600;
  cursor: pointer;
}

.cancel-btn { background: white; border: 1px solid #e2e8f0; color: #64748b; }
.confirm-btn { background: #ef4444; border: none; color: white; }

.empty-row {
  text-align: center;
  padding: 40px !important;
  color: #94a3b8;
  font-style: italic;
}

@media (max-width: 1024px) {
  .main-content { margin-left: 0; padding: 20px; }
}
</style>