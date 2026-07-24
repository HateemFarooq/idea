<script setup>
import { Head, router, Link, usePage } from "@inertiajs/vue3"
import { ref, watch } from "vue"
import AdminSidebar from "../Components/AdminSidebar.vue"
import FlashMessage from "../Components/FlashMessage.vue"

const page = usePage()
const props = defineProps({
  country: Object,
  errors: Object
})

const name = ref(props.country.name || "")

function update() {
  router.put(`/admin/countries/${props.country.id}`, {
    name: name.value
  })
}

watch(
  () => page.props.errors,
  (errors) => {
    if (errors?.name) name.value = props.country.name 
  }
)
</script>

<template>
  <div class="admin-layout">
    <Head title="Edit Country" />
    <AdminSidebar />

    <main class="main-content">
      <header class="page-header">
        <div class="header-title">
          <div class="title-with-icon">
            <span class="header-icon">🌍</span>
            <div>
              <h1>Edit Country</h1>
              <p>Modify the details for <strong>{{ props.country.name }}</strong></p>
            </div>
          </div>
        </div>
        <Link href="/admin/countries" class="back-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
          Back to List
        </Link>
      </header>

      <FlashMessage />

      <div class="form-card card-single">
        <div class="form-group">
          <label class="input-label">Country Name</label>
          <input 
            v-model="name" 
            type="text" 
            class="modern-input"
            :class="{ 'input-error': errors.name }"
          />
          <p v-if="errors.name" class="error-text">{{ errors.name }}</p>
        </div>

        <div class="form-actions">
          <button @click="update" class="save-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            Update Country
          </button>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
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
  transition: 0.2s;
}

.back-btn:hover {
  background: #f1f5f9;
  color: #0f172a;
  transform: translateX(-3px);
}

.form-card {
  background: white;
  max-width: 800px;
  padding: 40px;
  border-radius: 24px;
  border: 1px solid #f1f5f9;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
}

.card-single {
  max-width: 500px;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
  margin-bottom: 24px;
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
  background: #fcfdfe;
  transition: all 0.2s;
}

.modern-input:focus {
  outline: none;
  border-color: #6366f1;
  background: white;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.input-error {
  border-color: #ef4444 !important;
}

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

.form-actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 24px;
}

.save-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #0f172a;
  color: white;
  border: none;
  padding: 14px 32px;
  border-radius: 14px;
  font-weight: 700;
  cursor: pointer;
  transition: 0.2s;
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

@media (max-width: 1024px) {
  .main-content { margin-left: 0; padding: 24px; }
}

@media (max-width: 640px) {
  .form-grid { grid-template-columns: 1fr; }
}
</style>