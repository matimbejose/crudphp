<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/init.php'); // Inclui o arquivo de inicialização que define constantes e configurações básicas
include_once(ROOT_PATH . 'config/connection.php'); // Inclui a conexão com o banco de dados
include_once(ROOT_PATH . 'includes/header.php'); // Inclui o cabeçalho do site
include_once(ROOT_PATH . 'includes/sidebar.php'); // Inclui a barra lateral do site

// Prepara e executa a consulta para buscar todos os registros ativos da tabela 'tbl_crud'
$stmt = $pdo->prepare("SELECT * FROM tbl_crud WHERE como_soube_empresa = 'Amigos'");
$stmt->execute();
$cruds = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtém todos os registros como um array associativo

// Verifica se existe uma mensagem na sessão e exibe-a usando o toastr
if (!empty($_SESSION['msg'])): ?>
    <script>
        $(document).ready(function() {
            var msgType = "<?php echo $_SESSION['msg_type'] ?? 'info'; ?>";
            var msgContent = "<?php echo $_SESSION['msg']; ?>";

            // Exibe a mensagem conforme seu tipo (success, warning, error, info)
            switch (msgType) {
                case 'success':
                    toastr.success(msgContent);
                    break;
                case 'warning':
                    toastr.warning(msgContent);
                    break;
                case 'error':
                    toastr.error(msgContent);
                    break;
                default:
                    toastr.info(msgContent);
            }
            // Limpa a mensagem da sessão após exibi-la
            <?php unset($_SESSION['msg'], $_SESSION['msg_type']); ?>
        });
    </script>
<?php endif; ?>
<div class="content-body">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">CRUD</h5>
            </li>
            <li class="breadcrumb-item"><a href="<?= WEB_ROOT ?>">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Home </a>
            </li>
            <li class="breadcrumb-item active"><a href="<?= WEB_ROOT ?>crud/">CRUD Padrão</a></li>
        </ol>
    </div>
    <div class="container-fluid">
        
        <!-- Seção de cadastro -->
        <div class="row">
            <div class="col-xl-12 bst-seller">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="heading mb-0">Filtrar por atendimento</h4>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 bst-seller">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="d-flex justify-content-around">
                            <button class="btn btn-primary">Atendimento Diários</button>
                            <button class="btn btn-secondary">Atendimento Semanais</button>
                            <button class="btn btn-success">Atendimento Mensais</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Seção de visualização -->


        <!-- Seção de cadastro -->
        <div class="row">
            <div class="col-xl-12 bst-seller">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="heading mb-0">Nome atendimento</h4>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 bst-seller">
                <div class="card h-auto">
                    <div class="card-body">
                        <!-- Formulário de cadastro/edição -->
                        <form action="<?= WEB_ROOT ?>crud/actions.php" method="post">
                            <input type="hidden" name="crud_id" id="crud_id"> <!-- Campo oculto para o ID do registro -->
                            <input type="hidden" name="action" id="action"> <!-- Campo oculto para a ação (create ou update) -->
                            <div class="row">
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="nome" required>
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">Whatsapp</label>
                                    <input type="tel" class="form-control" name="whatsapp" id="whatsapp" pattern="\(\d{2}\) \d{5}-\d{4}" placeholder="(XX) XXXXX-XXXX" required>
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">Contanto 2</label>
                                    <input type="tel" class="form-control" name="contato2" id="contato2" pattern="\(\d{2}\) \d{5}-\d{4}" placeholder="(XX) XXXXX-XXXX" required>
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="XXX.XXX.XXX-XX" required>
                                </div>

                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">CEP</label>
                                    <input type="text" class="form-control" name="cep" id="cep" pattern="\d{5}-\d{3}" placeholder="XXXXX-XXX" required>
                                </div>

                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">Como fico sabendo da empresa ?</label>
                                    <select class="form-control selectpicker" name="como_soube_empresa" id="como_soube_empresa" data-live-search="true" required>
                                        <option value="">Selecione</option>
                                        <option value="Familiares">Familiares</option>
                                        <option value="Amigos">Amigos</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div id="button-container" class="col-sm-12">
                                    <button id="btn-submit" class="btn btn-success btn-block" type="submit">Salvar</button>
                                </div>
                                <div id="edit-button-container" class="col-sm-9" style="display: none;">
                                    <button id="btn-submit-edit" class="btn btn-primary btn-block" type="submit">Editar</button>
                                </div>
                                <div id="delete-button-container" class="col-sm-3" style="display: none;">
                                    <button id="btn-delete" class="btn btn-danger btn-block" type="button">Excluir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Seção de visualização -->
        <div class="row">
            <div class="col-xl-12 bst-seller">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="heading mb-0">Visualização</h4>
                </div>
                <div class="card h-auto">
                    <div class="card-body p-0">
                        <div class="table-responsive active-projects style-1 dt-filter exports">
                            <div class="tbl-caption"></div>
                            <table id="customer-tbl" class="table shorting">
                                <thead>
                                    <tr>
                                        <th>Editar</th>
                                        <th>Nome</th>
                                        <th>Whatsapp</th>
                                        <th>CEP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Loop através dos registros do banco de dados e exibe-os na tabela -->
                                    <?php foreach ($cruds as $crud): ?>
                                        <tr>
                                            <td>
                                                <div class="form-check custom-checkbox">
                                                    <input type="checkbox" class="form-check-input user-checkbox" id="customCheckBox<?= $crud['id'] ?>" data-resultado-id="<?= $crud['id'] ?>">
                                                    <label class="form-check-label" for="customCheckBox<?= $crud['id'] ?>"></label>
                                                </div>
                                            </td>
                                            <td><span><?= htmlspecialchars($crud['nome']) ?></span></td>
                                            <td><span><?= htmlspecialchars($crud['whatsapp']) ?></span></td>
                                            <td><span><?= htmlspecialchars($crud['cep']) ?></span></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Elemento HTML que armazena a configuração web root -->
<div id="config" data-web-root="<?= WEB_ROOT ?>"></div>
<?php include ROOT_PATH . 'includes/footer.php'; // Inclui o rodapé do site 
?>
</body>

</html>