<script setup>
import { usePage, router } from "@inertiajs/vue3"
import { computed, watch } from "vue"

const page = usePage()
const flash = computed(() => page.props.flash)

// This function clears the flash message from the Inertia state
const clearFlash = () => {
  // We manually nullify the flash props so the TransitionGroup triggers the 'leave' animation
  page.props.flash.success = null
  page.props.flash.error = null
}

// Watch for changes in flash messages
watch(
  () => page.props.flash,
  (newVal) => {
    if (newVal.success || newVal.error) {
      // Auto-hide after 5 seconds
      setTimeout(() => {
        clearFlash()
      }, 3000)
    }
  },
  { deep: true }
)
</script>

<template>
  <div class="flash-wrapper">
    <TransitionGroup name="toast">
      <div v-if="flash.success" class="toast success" key="success" @click="clearFlash">
        <div class="icon-circle">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <div class="content">
          <span class="title">Success</span>
          <p>{{ flash.success }}</p>
        </div>
      </div>

      <div v-if="flash.error" class="toast error" key="error" @click="clearFlash">
        <div class="icon-circle">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </div>
        <div class="content">
          <span class="title">Error</span>
          <p>{{ flash.error }}</p>
        </div>
      </div>
    </TransitionGroup>
  </div>
</template>

<style scoped>
.flash-wrapper {
  position: fixed;
  top: 32px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 9999;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  pointer-events: none;
}

.toast {
  pointer-events: auto;
  display: flex;
  align-items: center;
  gap: 16px;
  min-width: 350px;
  padding: 10px 20px;
  border-radius: 100px;
  background: white;
  cursor: pointer; /* User can click to dismiss early */
  box-shadow: 
    0 10px 15px -3px rgba(0, 0, 0, 0.1), 
    0 4px 6px -2px rgba(0, 0, 0, 0.05),
    0 0 0 1px rgba(0, 0, 0, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.8);
  transition: transform 0.2s ease;
}

.toast:hover {
  transform: scale(1.02); /* Subtle hover effect */
}

.icon-circle {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  flex-shrink: 0;
}

.content {
  display: flex;
  align-items: center;
  gap: 8px;
}

.content .title {
  font-weight: 800;
  font-size: 14px;
  white-space: nowrap;
}

.content p {
  margin: 0;
  font-size: 14px;
  color: #475569;
  font-weight: 500;
  white-space: nowrap;
}

/* Success Styling */
.success { border-bottom: 3px solid #10b981; }
.success .icon-circle { background: #ecfdf5; color: #10b981; }
.success .title { color: #064e3b; }

/* Error Styling */
.error { border-bottom: 3px solid #ef4444; }
.error .icon-circle { background: #fef2f2; color: #ef4444; }
.error .title { color: #7f1d1d; }

/* Animation Logic */
.toast-enter-active {
  transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.toast-leave-active {
  transition: all 0.4s ease-in;
}

.toast-enter-from {
  opacity: 0;
  transform: translateY(-60px) scale(0.8);
}
.toast-leave-to {
  opacity: 0;
  transform: translateY(-20px) scale(0.9);
}
</style>