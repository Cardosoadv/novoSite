<template>
  <div class="cliente-panel-view">
    <!-- Header -->
    <header class="page-header py-4">
      <div class="container px-3 px-md-5 mt-4 text-center">
        <h1 class="page-title text-gold" v-motion-fade-up>Painel do Cliente</h1>
        <p class="page-subtitle mx-auto text-muted" v-motion-fade-up :delay="100" v-if="cliente">
          Bem-vindo(a), {{ cliente.nome }}
        </p>
      </div>
    </header>

    <div class="container px-3 px-md-5 py-5">
      <!-- Loading State -->
      <div v-if="isLoading" class="text-center py-5">
        <div class="spinner-border text-gold" role="status">
          <span class="visually-hidden">Carregando...</span>
        </div>
        <p class="mt-3 text-muted">Acessando seus dados seguros...</p>
      </div>

      <!-- Erro -->
      <div v-else-if="errorMessage" class="alert alert-danger custom-alert text-center py-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-3 d-block mb-2"></i>
        {{ errorMessage }}
        <div class="mt-3">
          <router-link to="/area-cliente" class="btn btn-outline-gold">Voltar para o Login</router-link>
        </div>
      </div>

      <!-- Main Content (Autenticado) -->
      <div v-else-if="isAuthenticated">
        <!-- Lista de Processos -->
        <div v-if="!selectedProcesso" class="row justify-content-center">
          <div class="col-lg-10">
            <h3 class="text-gold mb-4"><i class="bi bi-briefcase me-2"></i>Meus Processos</h3>
            
            <div v-if="processos.length === 0" class="premium-card p-5 text-center">
              <i class="bi bi-inbox text-muted fs-1 mb-3"></i>
              <p class="text-muted mb-0">Nenhum processo encontrado vinculado ao seu cadastro.</p>
            </div>

            <div v-else class="list-group gap-3">
              <div 
                v-for="proc in processos" 
                :key="proc.id_processo" 
                class="premium-card p-4 process-card cursor-pointer"
                @click="selecionarProcesso(proc)"
              >
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                  <div>
                    <h5 class="text-white mb-1">{{ proc.numero_processo || 'Processo sem número' }}</h5>
                    <p class="text-gold mb-2 small">{{ proc.titulo_processo || 'Sem título' }}</p>
                  </div>
                  <span class="badge" :class="proc.status === 'Encerrado' ? 'bg-danger' : (proc.status === 'Arquivado' ? 'bg-secondary' : 'bg-success')">
                    {{ proc.status }}
                  </span>
                </div>
                
                <div class="text-muted small mt-2">
                  <i class="bi bi-person me-1"></i> Responsável: {{ proc.responsavel_nome || 'Não atribuído' }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Detalhes do Processo Selecionado -->
        <div v-else class="row justify-content-center">
          <div class="col-lg-10">
            <button @click="selectedProcesso = null" class="btn btn-outline-gold mb-4">
              <i class="bi bi-arrow-left me-2"></i>Voltar aos Processos
            </button>

            <!-- Card Principal -->
            <div class="premium-card p-4 p-md-5 mb-4">
              <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                  <h3 class="text-gold mb-1">{{ selectedProcesso.numero_processo }}</h3>
                  <h5 class="text-white">{{ selectedProcesso.titulo_processo }}</h5>
                </div>
                <span class="badge" :class="selectedProcesso.status === 'Encerrado' ? 'bg-danger' : (selectedProcesso.status === 'Arquivado' ? 'bg-secondary' : 'bg-success')">
                  {{ selectedProcesso.status }}
                </span>
              </div>

              <!-- Relatório Final (Se publicado) -->
              <div v-if="selectedProcesso.relatorio_final && selectedProcesso.relatorio_final_publicado == 1" class="relatorio-card p-4 mt-4 mb-4">
                <h4 class="text-gold mb-3"><i class="bi bi-file-earmark-text me-2"></i>Relatório Final de Encerramento</h4>
                <div class="relatorio-content text-white" v-html="formatarRelatorio(selectedProcesso.relatorio_final)"></div>
              </div>

              <!-- Dados Resumo -->
              <div class="row g-4 mt-2">
                <div class="col-md-6">
                  <div class="info-item">
                    <span class="info-label">Ramo do Direito</span>
                    <span class="info-value">{{ selectedProcesso.ramo_direito_nome || 'N/A' }}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-item">
                    <span class="info-label">Advogado Responsável</span>
                    <span class="info-value">{{ selectedProcesso.responsavel_nome || 'N/A' }}</span>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Ações (opcional - pode ser expandido depois com mensagens) -->
            <div class="premium-card p-4 text-center">
              <p class="text-muted mb-0">Para enviar documentos ou dúvidas, entre em contato através de nossos canais oficiais de atendimento.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';

export default {
  name: 'ClientePanel',
  setup() {
    const route = useRoute();
    const router = useRouter();
    
    const isLoading = ref(true);
    const isAuthenticated = ref(false);
    const errorMessage = ref('');
    const cliente = ref(null);
    
    const processos = ref([]);
    const selectedProcesso = ref(null);

    const baseUrl = window.__APP_CONFIG__?.apiUrl || '/';

    // Helper para chamadas autenticadas
    const apiFetch = async (endpoint, options = {}) => {
      const defaultHeaders = {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      };
      
      const config = {
        ...options,
        headers: { ...defaultHeaders, ...options.headers },
        credentials: 'include' // IMPORTANTE: Envia os cookies de sessão Shield
      };

      const response = await fetch(`${baseUrl}${endpoint}`, config);
      const data = await response.json().catch(() => ({}));

      if (!response.ok) {
        throw new Error(data.message || 'Ocorreu um erro na requisição.');
      }
      return data;
    };

    const verificarTokenEAutenticar = async (token) => {
      try {
        const response = await apiFetch('cliente/auth/verificar', {
          method: 'POST',
          body: JSON.stringify({ token })
        });
        
        if (response.success) {
          cliente.value = response.cliente;
          isAuthenticated.value = true;
          // Limpar token da URL por segurança
          router.replace({ path: route.path });
          await carregarProcessos();
        }
      } catch (err) {
        errorMessage.value = err.message || 'Link inválido ou expirado. Por favor, solicite um novo acesso.';
      } finally {
        isLoading.value = false;
      }
    };

    const carregarPerfilSessao = async () => {
      try {
        const response = await apiFetch('cliente/perfil');
        if (response.success) {
          cliente.value = response.data;
          isAuthenticated.value = true;
          await carregarProcessos();
        }
      } catch (err) {
        // Sessão não existe ou expirada
        errorMessage.value = 'Sessão expirada ou acesso negado. Por favor, faça login novamente.';
      } finally {
        isLoading.value = false;
      }
    };

    const carregarProcessos = async () => {
      try {
        const response = await apiFetch('cliente/processos');
        if (response.success) {
          processos.value = response.data || [];
        }
      } catch (err) {
        console.error('Erro ao carregar processos:', err);
      }
    };

    const selecionarProcesso = async (proc) => {
      try {
        isLoading.value = true;
        const response = await apiFetch(`cliente/processos/${proc.id_processo}`);
        if (response.success) {
          selectedProcesso.value = response.data;
        }
      } catch (err) {
        alert(err.message || 'Erro ao carregar detalhes do processo.');
      } finally {
        isLoading.value = false;
      }
    };

    const formatarRelatorio = (texto) => {
      if (!texto) return '';
      // Substitui quebras de linha por <br> e formatação markdown simples se desejar
      return texto.replace(/\n/g, '<br>');
    };

    onMounted(async () => {
      const tokenUrl = route.query.token;
      
      if (tokenUrl) {
        // Se tem token na URL, tentar validar e criar sessão
        await verificarTokenEAutenticar(tokenUrl);
      } else {
        // Se não tem token, verificar se já tem sessão ativa (cookies)
        await carregarPerfilSessao();
      }
    });

    return {
      isLoading,
      isAuthenticated,
      errorMessage,
      cliente,
      processos,
      selectedProcesso,
      selecionarProcesso,
      formatarRelatorio
    };
  }
}
</script>

<style scoped>
.cliente-panel-view {
  min-height: calc(100vh - 86px);
  background-color: var(--navy-dark);
}

.page-header {
  background: linear-gradient(180deg, var(--navy-medium) 0%, var(--navy-dark) 100%);
  border-bottom: 1px solid var(--glass-border);
}

.text-gold {
  color: var(--gold);
}

.premium-card {
  background: var(--glass-bg);
  backdrop-filter: blur(10px);
  border: 1px solid var(--glass-border);
  border-radius: 12px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
}

.process-card {
  transition: var(--transition-smooth);
}

.process-card:hover {
  transform: translateY(-3px);
  border-color: var(--gold);
  box-shadow: 0 10px 25px rgba(201, 168, 76, 0.15);
}

.cursor-pointer {
  cursor: pointer;
}

.custom-alert {
  background-color: rgba(220, 53, 69, 0.1);
  border: 1px solid rgba(220, 53, 69, 0.3);
  color: #ff6b6b;
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

.relatorio-card {
  background: rgba(0, 0, 0, 0.2);
  border-left: 4px solid var(--gold);
  border-radius: 0 8px 8px 0;
}

.relatorio-content {
  line-height: 1.6;
  font-size: 1.05rem;
}

.info-item {
  background: rgba(255, 255, 255, 0.03);
  padding: 1rem;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.info-label {
  display: block;
  font-size: 0.85rem;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 0.4rem;
}

.info-value {
  display: block;
  font-size: 1.1rem;
  color: var(--cream);
  font-weight: 500;
}
</style>
