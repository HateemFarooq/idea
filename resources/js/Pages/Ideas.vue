<script setup>
import { Head, router } from "@inertiajs/vue3"
import { ref, watch } from "vue"
import AdminSidebar from "../Components/AdminSidebar.vue"

const props = defineProps({
    ideas: Object,
    filters: Object
})

const search = ref(props.filters.search || "")

watch(search, (value) => {
    router.get('/admin/ideas', { search: value }, {
        preserveState: true,
        replace: true
    })
})
</script>

<template>
  <div class="admin-layout">
    <Head title="Idea Management" />
    <AdminSidebar />

    <main class="main-content">
      <header class="page-header">
        <div class="header-title">
          <h1>Idea Management</h1>
          <p>Review, moderate, and track submitted community ideas.</p>
        </div>
        <div class="header-stats">
          <div class="stat-card">
            <div class="stat-icon ideas">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            </div>
            <div class="stat-info">
               <span class="stat-label">Total Ideas</span>
               <span class="stat-value">{{ ideas.total }}</span>
            </div>
          </div>
        </div>
      </header>

      <div class="table-tools">
  <input
    v-model="search"
    type="text"
    placeholder="Search ideas..."
    class="search-input"
  />
</div>
      <div class="table-card">
        <div class="table-responsive">
          <table class="modern-table">
            <thead>
              <tr>
                <th>User</th>
                <th>Idea Content</th>
                <th>Steps </th>
                <th>Status</th>
                <th>Media</th>
                <th>Resources</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="idea in ideas.data" :key="idea.id">
                <td class="user-col">
                  <div class="user-info">
                    <div class="avatar sm">{{ idea.user?.name?.charAt(0) || '?' }}</div>
                    <span class="user-name">{{ idea.user?.name || 'Unknown' }}</span>
                  </div>
                </td>

                <td class="content-col">
                  <div class="idea-content">
                    <span class="idea-title">{{ idea.title }}</span>
                    <p class="idea-desc">{{ idea.description }}</p>
                  </div>
                </td>

                <td class="steps-col">
                  <div class="steps-container">
                    <div v-if="idea.steps?.length" class="step-counter">
                       
                       <span class="step-text">{{ idea.steps.length }} Steps</span>
                    </div>
                    <span v-else class="no-data">No steps</span>
                  </div>
                </td>

                <td>
                  <span class="status-badge" :class="idea.status?.toLowerCase() || 'pending'">
                    {{ idea.status || 'Pending' }}
                  </span>
                </td>

                <td>
                  <div v-if="idea.image" class="image-box">
                    <a :href="'/storage/' + idea.image" target="_blank" class="thumb-link">
                      <img :src="'/storage/' + idea.image" class="thumb" alt="Preview" />
                    </a>
                  </div>
                  <span v-else class="no-data">No Image</span>
                </td>

                <td>
                  <div v-if="idea.links?.length" class="links-wrapper">
                    <a v-for="(link, index) in idea.links" :key="index" :href="link" target="_blank" class="icon-link" title="Open Link">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                    </a>
                  </div>
                  <span v-else class="no-data">None</span>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="pagination">
  <button
    v-for="link in ideas.links"
    :key="link.label"
    v-html="link.label"
    :disabled="!link.url"
    @click="router.get(link.url)"
    class="page-btn"
  ></button>
</div>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
/* Base Layout */
.admin-layout { display: flex; background: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif; }
.main-content { flex: 1; margin-left: 260px; padding: 40px; }

/* Header & Stats */
.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
.header-title h1 { font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.02em; }
.header-title p { color: #64748b; font-size: 14px; margin-top: 4px; }

.stat-card {
  background: white;
  padding: 16px 24px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  gap: 16px;
  border: 1px solid #f1f5f9;
  box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
}
.stat-icon.ideas { background: #eef2ff; color: #6366f1; padding: 10px; border-radius: 12px; }
.stat-label { display: block; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; }
.stat-value { font-size: 20px; font-weight: 800; color: #0f172a; }

/* Table Styling */
.table-card { background: white; border-radius: 20px; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
.modern-table { width: 100%; border-collapse: collapse; }
.modern-table th { background: #f8fafc; padding: 16px 24px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; border-bottom: 1px solid #f1f5f9; }
.modern-table td { padding: 20px 24px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; color: #334155; }
.modern-table tr:hover { background: #fcfdfe; }

/* Content Columns */
.idea-title { display: block; font-weight: 700; color: #1e293b; font-size: 14px; margin-bottom: 4px; }
.idea-desc { color: #64748b; font-size: 13px; line-height: 1.5; max-width: 300px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

/* Steps Column Styling */
.step-counter { display: flex; flex-direction: column; gap: 6px; }
.step-dots { display: flex; gap: 4px; }
.dot { width: 6px; height: 6px; border-radius: 50%; background: #e2e8f0; }
.dot.filled { background: #6366f1; }
.step-text { font-size: 12px; font-weight: 600; color: #475569; }

/* User Info & Avatar */
.user-info { display: flex; align-items: center; gap: 10px; }
.avatar.sm { width: 32px; height: 32px; background: #6366f1; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px; }
.user-name { font-weight: 600; color: #0f172a; font-size: 14px; }

/* Badges & Media */
.status-badge { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; display: inline-block; }
.status-badge.approved { background: #f0fdf4; color: #16a34a; }
.status-badge.pending { background: #fff7ed; color: #d97706; }

.thumb { width: 48px; height: 48px; border-radius: 10px; object-fit: cover; border: 1px solid #f1f5f9; transition: transform 0.2s; }
.thumb:hover { transform: scale(1.1); }

.links-wrapper { display: flex; gap: 8px; }
.icon-link { background: #f1f5f9; color: #64748b; padding: 6px; border-radius: 8px; display: flex; align-items: center; transition: all 0.2s; }
.icon-link:hover { background: #e2e8f0; color: #6366f1; }

.no-data { color: #cbd5e1; font-style: italic; font-size: 12px; }

@media (max-width: 1024px) { .main-content { margin-left: 0; padding: 20px; } }

.table-tools{
  padding:20px;
  border-bottom:1px solid #f1f5f9;
}

.search-input{
  width:320px;
  padding:8px 12px;
  border:1px solid #e2e8f0;
  border-radius:8px;
}

.pagination{
  display:flex;
  gap:6px;
  padding:20px;
}

.page-btn{
  padding:6px 12px;
  border:1px solid #e2e8f0;
  background:white;
  border-radius:6px;
  cursor:pointer;
}

.page-btn:hover{
  background:#f1f5f9;
}
</style>