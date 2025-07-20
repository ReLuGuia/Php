<?php include('../partials/header.php'); ?>

<div class="container">
    <h2>Edição dos Dados da Clínica</h2>
    
    <form class="clinic-form">
        <div class="form-group">
            <label for="nome">Nome da Clínica:</label>
            <input type="text" id="nome" name="nome" value="Clínica Saúde Total" required>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="cnpj">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" value="12.345.678/0001-99" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="(11) 99999-8888" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="endereco">Endereço Completo:</label>
            <input type="text" id="endereco" name="endereco" value="Rua das Flores" required>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero" value="100">
            </div>
            
            <div class="form-group">
                <label for="complemento">Complemento:</label>
                <input type="text" id="complemento" name="complemento" value="Sala 501">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" value="Centro" required>
            </div>
            
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" value="São Paulo" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="SP" selected>São Paulo</option>
                    <!-- Outros estados -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" value="01001-000">
            </div>
        </div>
        
        <h3>Horário de Funcionamento</h3>
        
        <div class="form-row">
            <div class="form-group">
                <label for="abertura">Abertura:</label>
                <input type="time" id="abertura"