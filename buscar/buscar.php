<?php include('../partials/header.php'); ?>

<div class="container">
    <h2>Busca de Médicos</h2>
    
    <div class="search-box">
        <form class="search-form">
            <div class="form-group">
                <input type="text" name="busca" placeholder="Digite nome, CRM ou especialidade">
                <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </form>
    </div>
    
    <div class="results-container">
        <div class="fake-results-notice">
            <p>Sistema sem integração com banco de dados - resultados simulados</p>
        </div>
        
        <div class="doctor-card">
            <div class="doctor-info">
                <h3>Dr. Carlos Eduardo Silva</h3>
                <p><strong>CRM:</strong> SP-123456</p>
                <p><strong>Especialidade:</strong> Cardiologia</p>
                <p><strong>Telefone:</strong> (11) 99999-8888</p>
            </div>
            <div class="doctor-actions">
                <a href="#" class="btn-small">Visualizar</a>
                <a href="cadastro.php" class="btn-small">Editar</a>
            </div>
        </div>
        
        <div class="doctor-card">
            <div class="doctor-info">
                <h3>Dra. Ana Paula Oliveira</h3>
                <p><strong>CRM:</strong> RJ-654321</p>
                <p><strong>Especialidade:</strong> Pediatria</p>
                <p><strong>Telefone:</strong> (21) 97777-6666</p>
            </div>
            <div class="doctor-actions">
                <a href="#" class="btn-small">Visualizar</a>
                <a href="cadastro.php" class="btn-small">Editar</a>
            </div>
        </div>
    </div>
</div>

<?php include('../partials/footer.php'); ?>