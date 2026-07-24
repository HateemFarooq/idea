<script setup>
import { Head, router } from "@inertiajs/vue3"
import AdminSidebar from "../Components/AdminSidebar.vue"

defineProps({
  idea: Object
})
</script>

<template>
  <div class="admin-layout">
    <Head title="Idea Steps" />
    <AdminSidebar />

    <main class="main-content">
      <header class="page-header">
        <div class="header-title">
          <button class="back-link" @click="router.get('/admin/ideas')">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <line x1="19" y1="12" x2="5" y2="12"></line>
              <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Ideas
          </button>
          <h1>Steps for: {{ idea.title }}</h1>
          <p>Review and track the progress of each phase for this idea.</p>
        </div>
      </header>

      <div class="table-card">
        <div v-if="idea.steps.length" class="table-responsive">
          <table class="modern-table">
            <thead>
              <tr>
                <th style="width: 80px;">#</th>
                <th>Step Description</th>
                <th style="width: 150px;">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(step, index) in idea.steps" :key="step.id">
                <td class="index-col">
                  <div class="step-number">{{ index + 1 }}</div>
                </td>
                <td class="content-col">
                  <p class="step-desc">{{ step.description }}</p>
                </td>
                <td>
                  <span :class="step.completed ? 'status-badge completed' : 'status-badge pending'">
                    {{ step.completed ? 'Completed' : 'Pending' }}
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-else class="empty-state">
          <p class="no-data">No steps have been added to this idea yet.</p>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
/* Base Layout */
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

/* Header */
.page-header {
  margin-bottom: 32px;
}

.back-link {
  display: flex;
  align-items: center;
  gap: 8px;
  background: transparent;
  border: none;
  color: #6366f1;
  font-weight: 600;
  font-size: 14px;
  padding: 0;
  margin-bottom: 12px;
  cursor: pointer;
  transition: transform 0.2s;
}

.back-link:hover {
  transform: translateX(-4px);
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
  padding: 20px 24px;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
  color: #334155;
}

.modern-table tr:hover {
  background: #fcfdfe;
}

/* Columns */
.step-number {
  width: 28px;
  height: 28px;
  background: #f1f5f9;
  color: #64748b;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 12px;
}

.step-desc {
  font-size: 14px;
  line-height: 1.6;
  color: #1e293b;
  margin: 0;
}

/* Status Badges */
.status-badge {
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  display: inline-block;
}

.status-badge.completed {
  background: #f0fdf4;
  color: #16a34a;
}

.status-badge.pending {
  background: #fff7ed;
  color: #d97706;
}

/* Empty State */
.empty-state {
  padding: 60px;
  text-align: center;
}

.no-data {
  color: #94a3b8;
  font-style: italic;
  font-size: 14px;
}

/* Responsive */
@media (max-width: 1024px) {
  .main-content {
    margin-left: 0;
    padding: 20px;
  }
}
</style>