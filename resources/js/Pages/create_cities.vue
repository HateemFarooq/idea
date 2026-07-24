<script setup>
import { Head, router } from "@inertiajs/vue3"
import { ref } from "vue"
import AdminSidebar from "../Components/AdminSidebar.vue"
import FlashMessage from "../Components/FlashMessage.vue"
import { Link } from "@inertiajs/vue3"

const props = defineProps({
  states: Array,
  errors: Object
})

const name = ref("")
const state_id = ref("")

function submit() {
  router.post('/admin/cities/store', {
    name: name.value,
    state_id: state_id.value
  }, {
    onSuccess: () => {
      name.value = ""
      state_id.value = ""
    }
  })
}
</script>

<template>
  <div class="admin-layout">
    <Head title="Add City" />
    <AdminSidebar />

    <main class="main-content">
      <header class="page-header">
        <div class="header-title">
          <div class="title-with-icon">
            <span class="header-icon">🏙️</span>
            <div>
              <h1>Add New City</h1>
              <p>Define local cities and assign them to specific states.</p>
            </div>
          </div>
        </div>
        <Link href="/admin/cities" class="back-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
          Back to List
        </Link>
      </header>

      <FlashMessage />

      <div class="form-card">
        <div class="form-grid">
          <div class="form-group">
            <label class="input-label">Parent State</label>
            <div class="select-wrapper">
              <select v-model="state_id" class="modern-input" :class="{ 'input-error': props.errors.state_id }">
                <option value="" disabled>Choose a state...</option>
                <option v-for="s in states" :key="s.id" :value="s.id">{{ s.name }}</option>
              </select>
            </div>
            <p v-if="props.errors.state_id" class="error-text">{{ props.errors.state_id }}</p>
          </div>

          <div class="form-group">
            <label for="name" class="input-label">City Name</label>
            <input 
              id="name"
              v-model="name" 
              placeholder="e.g. Paris" 
              class="modern-input"
              :class="{ 'input-error': props.errors.name }"
            />
            <p v-if="props.errors.name" class="error-text">{{ props.errors.name }}</p>
          </div>
        </div>

        <div class="form-actions">
          <button @click="submit" class="save-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            Save City
          </button>
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

/* Header Section */
.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
}

.title-with-icon {
  display: flex;
  align-items: center;
  gap: 16px;
}

.header-icon {
  font-size: 32px;
  background: white;
  padding: 10px;
  border-radius: 16px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
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

.back-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  background: white;
  color: #64748b;
  padding: 10px 18px;
  border-radius: 12px;
  text-decoration: none;
  font-size: 14px;
  font-weight: 600;
  border: 1px solid #e2e8f0;
  transition: all 0.2s;
}

.back-btn:hover {
  background: #f1f5f9;
  color: #0f172a;
  transform: translateX(-3px);
}

/* Form Card */
.form-card {
  background: white;
  max-width: 800px;
  padding: 40px;
  border-radius: 24px;
  border: 1px solid #f1f5f9;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
}

.card-single {
  max-width: 500px; /* Narrower card for single-input country form */
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
  margin-bottom: 32px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.input-label {
  font-size: 12px;
  font-weight: 700;
  color: #475569;
  margin-bottom: 10px;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.modern-input {
  width: 100%;
  padding: 14px 16px;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  font-size: 15px;
  color: #1e293b;
  transition: all 0.2s;
  background: #fcfdfe;
}

.modern-input:focus {
  outline: none;
  border-color: #6366f1;
  background: white;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.input-error {
  border-color: #ef4444 !important;
  background: #fffafb;
}

/* Select Wrapper Customization */
.select-wrapper {
  position: relative;
}

.select-wrapper::after {
  content: "↓";
  font-size: 14px;
  color: #94a3b8;
  position: absolute;
  right: 16px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}

select.modern-input {
  appearance: none;
  cursor: pointer;
}

/* Actions */
.form-actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 8px;
}

.save-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #0f172a; /* Darker, more professional button */
  color: white;
  border: none;
  padding: 14px 32px;
  border-radius: 14px;
  font-weight: 700;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.2s;
}

.save-btn:hover {
  background: #1e293b;
  transform: translateY(-2px);
  box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.2);
}

.error-text {
  color: #ef4444;
  font-size: 13px;
  margin-top: 8px;
  font-weight: 500;
}

/* Responsive */
@media (max-width: 1024px) {
  .main-content { margin-left: 0; padding: 24px; }
  .form-card { padding: 24px; }
}

@media (max-width: 640px) {
  .form-grid { grid-template-columns: 1fr; gap: 20px; }
  .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
}
</style>