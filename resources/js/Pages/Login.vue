<script setup>
import { Head, router, usePage } from "@inertiajs/vue3"
import { ref } from "vue"
import FlashMessage from "../Components/FlashMessage.vue"

const email = ref("")
const password = ref("")
const loading = ref(false)

const page = usePage()

function login(){
    loading.value = true
    router.post('/admin/login', {
        email: email.value,
        password: password.value
    }, {
        onFinish: () => loading.value = false
    })
}
</script>

<template>
  <Head title="Admin Login" />
  <FlashMessage />

  <div class="login-container">
    <div class="decorative-blob"></div>
    
    <div class="login-card">
      <div class="card-header">
        <div class="logo-area">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
        </div>
        <h1>Portal Login</h1>
        <p>Enter your details to access the management console.</p>
      </div>

      <div v-if="page.props.errors.email === 'Invalid credentials'" class="alert-error">
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
         Access Denied: Invalid Credentials
      </div>

      <form @submit.prevent="login" class="login-form">
        <div class="form-group" :class="{ 'has-error': page.props.errors.email }">
          <label>Email Address</label>
          <div class="input-wrapper">
            <input type="email" v-model="email" placeholder="name@company.com" >
          </div>
          <span v-if="page.props.errors.email && page.props.errors.email !== 'Invalid credentials'" class="error-msg">
            {{ page.props.errors.email }}
          </span>
        </div>

        <div class="form-group" :class="{ 'has-error': page.props.errors.password }">
          <label>Password</label>
          <div class="input-wrapper">
            <input type="password" v-model="password" placeholder="••••••••" >
          </div>
          <span v-if="page.props.errors.password" class="error-msg">{{ page.props.errors.password }}</span>
        </div>

        <button type="submit" class="btn-primary" :disabled="loading">
          <span v-if="!loading">Sign In</span>
          <span v-else class="loader"></span>
        </button>
      </form>
    </div>
    
    <p class="copyright">© 2026 Admin Systems • v1.0.4</p>
  </div>
</template>

<style scoped>
.login-container {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-color: #f8fafc;
  background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
  background-size: 24px 24px;
  padding: 20px;
  position: relative;
  overflow: hidden;
}

.decorative-blob {
  position: absolute;
  width: 500px;
  height: 500px;
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
  filter: blur(80px);
  border-radius: 50%;
  top: -100px;
  right: -100px;
}

.login-card {
  background: white;
  width: 100%;
  max-width: 440px;
  padding: 48px;
  border-radius: 24px;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
  border: 1px solid rgba(226, 232, 240, 0.8);
  z-index: 1;
}

.card-header { text-align: center; margin-bottom: 32px; }

.logo-area {
  background: #6366f1;
  color: white;
  width: 56px;
  height: 56px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
}

h1 { font-size: 24px; font-weight: 800; color: #0f172a; letter-spacing: -0.025em; }
.card-header p { color: #64748b; font-size: 14px; margin-top: 8px; }

.alert-error {
  background: #fff1f2;
  border: 1px solid #ffe4e6;
  color: #e11d48;
  padding: 12px 16px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 24px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.form-group { margin-bottom: 20px; }
.form-group label { display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.025em; }

.input-wrapper input {
  width: 100%;
  height: 48px;
  padding: 0 16px;
  background: #f1f5f9;
  border: 2px solid transparent;
  border-radius: 12px;
  font-size: 15px;
  color: #1e293b;
  transition: all 0.2s;
}

.input-wrapper input:focus {
  background: white;
  border-color: #6366f1;
  outline: none;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.error-msg { color: #e11d48; font-size: 12px; font-weight: 500; margin-top: 6px; display: block; }

.btn-primary {
  width: 100%;
  height: 50px;
  background: #0f172a;
  color: white;
  border: none;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.3s;
  margin-top: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.btn-primary:hover:not(:disabled) { background: #1e293b; transform: translateY(-1px); box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.3); }
.btn-primary:disabled { opacity: 0.7; cursor: not-allowed; }

.copyright { margin-top: 32px; font-size: 12px; color: #94a3b8; font-weight: 500; }

/* Simple Loader */
.loader {
  width: 20px;
  height: 20px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: white;
  animation: spin 0.8s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }
</style>