<template>
  <div class="area-cliente-view">
    <!-- Header Decorativo (Hero minimalista) -->
    <header class="page-header py-5">
      <div class="container px-3 px-md-5 mt-4">
        <h1 class="page-title text-center" v-motion-fade-up>Área do Cliente</h1>
        <p class="page-subtitle text-center mx-auto" v-motion-fade-up :delay="100">
          Acesse seus processos e documentos de forma segura.
        </p>
      </div>
    </header>

    <!-- Formulário de Magic Link -->
    <section class="magic-link-section py-5">
      <div class="container px-3 px-md-5">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8">
            <div class="login-card premium-card p-4 p-md-5" v-motion-fade-up :delay="200">
              <h2 class="card-title text-center mb-4">Acesso Seguro</h2>
              <p class="text-center text-muted mb-4">
                Insira o seu e-mail cadastrado para receber um link mágico de acesso à plataforma.
              </p>

              <form @submit.prevent="requestMagicLink" v-if="!isSuccess">
                <div class="mb-4 form-floating-custom">
                  <input 
                    type="email" 
                    id="email" 
                    v-model="form.email" 
                    class="form-control premium-input" 
                    placeholder="Seu E-mail" 
                    required
                    :disabled="isLoading"
                  />
                  <label for="email">E-mail Cadastrado</label>
                </div>

                <div v-if="errorMessage" class="alert alert-danger custom-alert" role="alert">
                  {{ errorMessage }}
                </div>

                <button 
                  type="submit" 
                  class="btn-premium w-100 mt-2" 
                  :disabled="isLoading"
                >
                  <span v-if="isLoading" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                  {{ isLoading ? 'Enviando...' : 'Receber Link Mágico' }}
                </button>
              </form>

              <!-- Mensagem de Sucesso -->
              <div v-else class="success-message text-center py-4" aria-live="polite">
                <div class="icon-success mb-3">
                  <i class="bi bi-envelope-check-fill text-gold fs-1"></i>
                </div>
                <h3 class="mb-3">Link Enviado!</h3>
                <p class="text-muted">
                  Enviamos um link mágico para <strong>{{ form.email }}</strong>. <br>
                  Verifique sua caixa de entrada e sua pasta de spam.
                </p>
                <button @click="resetForm" class="btn btn-outline-gold mt-3">
                  Tentar outro e-mail
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'AreaCliente',
  setup() {
    const form = ref({
      email: ''
    });

    const isLoading = ref(false);
    const isSuccess = ref(false);
    const errorMessage = ref('');

    const requestMagicLink = async () => {
      isLoading.value = true;
      errorMessage.value = '';

      try {
        // Integração com a API de Processos
        const baseUrl = window.__APP_CONFIG__?.apiUrl;
        const response = await fetch(`${baseUrl}cliente/auth/solicitar`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ email: form.value.email })
        });

        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Ocorreu um erro ao solicitar o link de acesso. Verifique se o e-mail está correto.');
        }

        isSuccess.value = true;
      } catch (error) {
        errorMessage.value = error.message;
      } finally {
        isLoading.value = false;
      }
    };

    const resetForm = () => {
      isSuccess.value = false;
      form.value.email = '';
      errorMessage.value = '';
    };

    return {
      form,
      isLoading,
      isSuccess,
      errorMessage,
      requestMagicLink,
      resetForm
    };
  }
}
</script>

<style scoped>
/* ==========================================================================
   ESTILOS PREMIUM DA ÁREA DO CLIENTE
   ========================================================================== */
.area-cliente-view {
  min-height: calc(100vh - 86px);
  background-color: var(--navy-dark);
}

.page-header {
  background: linear-gradient(180deg, var(--navy-medium) 0%, var(--navy-dark) 100%);
  border-bottom: 1px solid var(--glass-border);
}

.page-title {
  font-family: var(--font-serif);
  color: var(--gold);
  font-size: 3rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.page-subtitle {
  color: var(--text-muted);
  font-size: 1.1rem;
  max-width: 600px;
}

.premium-card {
  background: var(--glass-bg);
  backdrop-filter: blur(10px);
  border: 1px solid var(--glass-border);
  border-radius: 12px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
}

.card-title {
  font-family: var(--font-serif);
  color: var(--gold);
}

.form-floating-custom {
  position: relative;
}

.premium-input {
  background-color: rgba(255, 255, 255, 0.03) !important;
  border: 1px solid rgba(255, 255, 255, 0.1) !important;
  color: var(--cream) !important;
  padding: 1.2rem 1rem;
  border-radius: 6px;
  transition: var(--transition-smooth);
}

.premium-input:focus {
  background-color: rgba(255, 255, 255, 0.05) !important;
  border-color: var(--gold) !important;
  box-shadow: 0 0 0 0.25rem rgba(201, 168, 76, 0.1) !important;
}

.form-floating-custom label {
  position: absolute;
  top: 50%;
  left: 1rem;
  transform: translateY(-50%);
  color: var(--text-muted);
  transition: var(--transition-smooth);
  pointer-events: none;
}

.premium-input:focus ~ label,
.premium-input:not(:placeholder-shown) ~ label {
  top: 0;
  font-size: 0.8rem;
  background-color: var(--navy-dark);
  padding: 0 0.5rem;
  color: var(--gold);
}

.btn-premium {
  background: linear-gradient(135deg, var(--gold), var(--gold-deep));
  color: var(--navy-dark);
  border: none;
  padding: 1rem;
  font-weight: 600;
  border-radius: 6px;
  letter-spacing: 0.05em;
  transition: var(--transition-smooth);
}

.btn-premium:hover:not(:disabled) {
  background: linear-gradient(135deg, var(--gold-hover), var(--gold));
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(201, 168, 76, 0.3);
}

.btn-premium:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.custom-alert {
  background-color: rgba(220, 53, 69, 0.1);
  border: 1px solid rgba(220, 53, 69, 0.3);
  color: #ff6b6b;
  font-size: 0.9rem;
}

.btn-outline-gold {
  color: var(--gold);
  border: 1px solid var(--gold);
  background: transparent;
  transition: var(--transition-smooth);
}

.btn-outline-gold:hover {
  background: var(--gold);
  color: var(--navy-dark);
}

.text-gold {
  color: var(--gold);
}
</style>
