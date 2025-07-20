<?php include('../partials/header.php'); ?>

<div class="container">
    <h2>Cadastro de Médico</h2>
    
    <form class="doctor-form">
        <div class="form-row">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="crm">CRM:</label>
                <input type="text" id="crm" name="crm" placeholder="CRM/UF-123456" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00">
            </div>
            
            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000">
            </div>
            
            <div class="form-group">
                <label for="especialidade">Especialidade:</label>
                <select id="especialidade" name="especialidade" required>
                    <option value="">Selecione</option>
                    <option value="cardiologia">Cardiologia</option>
                    <option value="dermatologia">Dermatologia</option>
                    <option value="ortopedia">Ortopedia</option>
                    <option value="pediatria">Pediatria</option>
                    <option value="clinico">Clínico Geral</option>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="nascimento">Data Nascimento:</label>
                <input type="date" id="nascimento" name="nascimento">
            </div>
            
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo">
                    <option value="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                </select>
            </div>
        </div>
        
        <div class="form-group full-width">
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco">
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-primary">Salvar Cadastro</button>
            <button type="reset" class="btn-secondary">Limpar Formulário</button>
            <a href="buscar.php" class="btn-link">Buscar Médico</a>
        </div>
    </form>
</div>

<?php include('../partials/footer.php'); ?>