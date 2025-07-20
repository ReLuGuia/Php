<?php include('../partials/header.php'); ?>

<div class="container">
    <h2>Listagem de Médicos</h2>
    
    <div class="list-actions">
        <a href="cadastro.php" class="btn-primary">Novo Médico</a>
        <a href="buscar.php" class="btn-secondary">Busca Avançada</a>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CRM</th>
                <th>Especialidade</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Dr. Carlos Eduardo</td>
                <td>SP-123456</td>
                <td>Cardiologia</td>
                <td>(11) 98888-7777</td>
                <td class="actions">
                    <a href="#" class="btn-icon" title="Visualizar"><i class="fas fa-eye"></i></a>
                    <a href="cadastro.php" class="btn-icon" title="Editar"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Dra. Fernanda Lima</td>
                <td>SP-789012</td>
                <td>Dermatologia</td>
                <td>(11) 95555-4444</td>
                <td class="actions">
                    <a href="#" class="btn-icon" title="Visualizar"><i class="fas fa-eye"></i></a>
                    <a href="cadastro.php" class="btn-icon" title="Editar"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Dr. Ricardo Almeida</td>
                <td>MG-345678</td>
                <td>Ortopedia</td>
                <td>(31) 97777-5555</td>
                <td class="actions">
                    <a href="#" class="btn-icon" title="Visualizar"><i class="fas fa-eye"></i></a>
                    <a href="cadastro.php" class="btn-icon" title="Editar"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="pagination">
        <span class="page-info">Página 1 de 1</span>
        <button disabled>Anterior</button>
        <button class="active">1</button>
        <button disabled>Próxima</button>
    </div>
</div>

<?php include('../partials/footer.php'); ?>