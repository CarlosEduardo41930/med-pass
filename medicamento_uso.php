<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicamentos em Uso</title>
  <link rel="stylesheet" href="estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <!-- Top bar -->
  <div class="topbar">
    <a href="#" class="topbar-icon"> 
      <i class="fa-solid fa-house"></i> 
    </a>
    <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    <a href="#" class="topbar-icon">
      <i class="fa-solid fa-bars"></i>
    </a>
  </div>

  <!-- Sub-header -->
  <div class="subheader">
    <a href="#" class="back-btn">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <span class="subheader-title">Medicamentos em Uso</span>
    <div class="subheader-spacer"></div>
  </div>

  <!-- Main content -->
  <div class="content">

    <!-- Table -->
    <table class="med-table">
      <thead>
        <tr>
          <th>Medicamento</th>
          <th>Dose</th>
          <th>Frequência</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Osimertinib (Tagrisso)</td>
          <td>80 mg</td>
          <td>1 Comprimido, uma vez ao dia (Diário)</td>
        </tr>
        <tr>
          <td>Pemetrexede</td>
          <td>500 mg/m²</td>
          <td>A cada 21 dias</td>
        </tr>
        <tr>
          <td>Insulina Glargina (Lantus)</td>
          <td>14 unidades</td>
          <td>1 Vez ao dia</td>
        </tr>
        <tr>
          <td>Insulina Asparte (Novorapid)</td>
          <td>Variável, calculada por bomba</td>
          <td>1U a cada 10g de Carboidrato</td>
        </tr>
      </tbody>
    </table>

    <!-- Bottom row -->
    <div class="bottom-row">
      <div class="cards">

        <div class="card active">
          <i class="fa-solid fa-pills"></i>
          <span class="card-label">Medicamentos<br>em Uso</span>
        </div>

        <div class="card">
          <i class="fa-solid fa-phone-flip"></i>
          <span class="card-label">Contato de<br>Emergência</span>
        </div>

        <div class="card">
          <i class="fa-solid fa-file-medical"></i>
          <span class="card-label">Receita<br>Médica</span>
        </div>

        <div class="card">
          <i class="fa-solid fa-clock-rotate-left"></i>
          <span class="card-label">Histórico<br>Familiar</span>
        </div>

      </div>

      <div class="card-number">
        <p>Número da carterinha:</p>
        <span>12345678-0</span>
      </div>
    </div>

  </div>
</body>
</html>