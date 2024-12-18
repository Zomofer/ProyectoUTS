<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Muro UTS</title>
  <link rel="stylesheet" href="css/Muro.css">
  <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
  <div style="display: flex; height: 100vh;">
    <div class="containerEmpty"></div>
    <div class="app-container container">
      <!-- Encabezado -->
      <header class="header">
        <div class="profile-icon">
          <img src="src/account_circle_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" alt="Icono de perfil">
        </div>
        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;" id="equis">
          <path d="M17 18.02C16.8688 18.0216 16.7388 17.9957 16.6183 17.9441C16.4977 17.8924 16.3893 17.8161 16.3 17.72L0.3 1.72C-0.1 1.32 -0.1 0.7 0.3 0.3C0.7 -0.1 1.32 -0.1 1.72 0.3L17.7 16.32C18.1 16.72 18.1 17.34 17.7 17.74C17.5 17.94 17.24 18.04 17 18.04V18.02Z" fill="#74B945"/>
          <path d="M1 18C0.868848 18.0016 0.738814 17.9757 0.618257 17.9241C0.497701 17.8724 0.389292 17.7961 0.3 17.7C-0.1 17.3 -0.1 16.68 0.3 16.28L16.3 0.3C16.7 -0.1 17.32 -0.1 17.72 0.3C18.12 0.7 18.12 1.32 17.72 1.72L1.7 17.7C1.5 17.9 1.24 18 1 18Z" fill="#74B945"/>
        </svg>
      </header>
      <div class="head" id="head">
        <span>Muro</span>
        <button class="add-note" id="createNote" onclick="createNewNote">Agregar nota ➕</button>
      </div>

      <!-- Muro de notas -->
      <main class="wall" id="wall">
        <?php
        include('php/procesar.php');

        // Crear conexión a la base de datos
        $miconexion = new ConexionMysql();
        $miconexion->CrearConexion();

        // Consulta para obtener las notas
        $sql = "SELECT * FROM notas";
$result = $miconexion->EjecutarSQL($sql);

if ($result) {
    // Procesar resultados si existen filas
    while ($row = $miconexion->ObtenerFilas($result)) {
        $titulo = isset($row["Titulo"]) ? ($row["Titulo"]) : 'Sin título';
        $descripcion = isset($row['Descripcion']) ? htmlspecialchars($row['Descripcion']) : 'Sin descripción';
        $fechaInicio = isset($row['Fecha']) ? htmlspecialchars($row['Fecha']) : 'No definida';
        $fechaFin = isset($row['FechaF']) ? htmlspecialchars($row['FechaF']) : 'No definida';
        $id = isset($row['Id']) ? htmlspecialchars($row['Id']) : 'No definida';

        echo "
        <div class='note'>
            <h3>{$titulo}</h3>
            <p>{$descripcion}</p>
            <p><strong>Fecha inicio:</strong> {$fechaInicio}</p>
            <p><strong>Fecha fin:</strong> {$fechaFin}</p>
            <form method='post' action='php/procesar.php'>
                <input type='text' name='Id' value=${id} style='display:none' />
                <input type='submit' name='btnEliminar' value='Eliminar' class='delete-btn' />
            </form>
        </div>";
    }
} else {
    // Mostrar mensaje si no hay resultados
    echo "<h2>No se encontraron notas.</h2>";
}
        ?>
      </main>

      <main class="wall" style="display: none;" id="form">
        <form action="php/procesar.php" method="post">
          <section>
            <label style="display: block; padding: 5px 0px;" for="title">Titulo</label>
            <input type="text" name="Titulo" id="title">
          </section>
          <section>
            <label for="description" style="display: block; padding: 5px 0px;">Descripcion</label>
            <input type="text" name="Descripcion" id="description">
          </section>
          <section>
            <aside>
              <label for="fecha" style="display: block; padding: 5px 0px;">Fecha</label>
            </aside>
            <aside style="display: flex; gap: 15px;">
              <input type="date" name="Fecha" id="fecha">
              a 
              <input type="date" name="FechaF" id="fechaf">
            </aside>
            <aside>
              <button class="register" name="btnRegistrar" value="registrar" type="submit">Registrar</button>            
            </aside>
          </section>
        </form>
      </main>

      <!-- Barra de navegación -->
      <nav class="bottom-nav">
        <a href="notas.html" class="nav-item" data-page="notas">
            <span>
                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M31.4 17H33M27.4 6.6L29 5M17 2.6V1M6.6 6.6L5 5M2.6 17H1M13.8 33H20.2M25 17C24.9996 15.5578 24.6093 14.1425 23.8705 12.9039C23.1316 11.6653 22.0717 10.6495 20.8028 9.96392C19.534 9.27835 18.1034 8.94855 16.6624 9.0094C15.2215 9.07026 13.8238 9.51951 12.6173 10.3096C11.4107 11.0997 10.4402 12.2013 9.80844 13.4978C9.17666 14.7943 8.9071 16.2374 9.0283 17.6745C9.14949 19.1117 9.65693 20.4893 10.4969 21.6617C11.3369 22.834 12.4782 23.7575 13.8 24.3344V28.2H20.2V24.3344C21.627 23.7116 22.8413 22.6859 23.6939 21.3831C24.5465 20.0803 25.0004 18.557 25 17Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                            
            </span>
            <p>Notas</p>
        </a>
        <a href="horario.html" class="nav-item" data-page="horario">
            <span>
                <svg width="10" height="10" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.2813 29H2.71875C1.21438 29 0 27.7934 0 26.2986V4.68764C0 3.19288 1.21438 1.98627 2.71875 1.98627H26.2813C27.7856 1.98627 29 3.19288 29 4.68764V26.2986C29 27.7934 27.7856 29 26.2813 29ZM2.71875 3.78718C2.21125 3.78718 1.8125 4.18338 1.8125 4.68764V26.2986C1.8125 26.8029 2.21125 27.1991 2.71875 27.1991H26.2813C26.7888 27.1991 27.1875 26.8029 27.1875 26.2986V4.68764C27.1875 4.18338 26.7888 3.78718 26.2813 3.78718H2.71875Z" fill="white"/>
                    <path d="M8.15625 7.15068C7.64875 7.15068 7.25 6.7574 7.25 6.25685V0.893836C7.25 0.393288 7.64875 0 8.15625 0C8.66375 0 9.0625 0.393288 9.0625 0.893836V6.25685C9.0625 6.7574 8.66375 7.15068 8.15625 7.15068ZM20.8438 7.15068C20.3363 7.15068 19.9375 6.7574 19.9375 6.25685V0.893836C19.9375 0.393288 20.3363 0 20.8438 0C21.3513 0 21.75 0.393288 21.75 0.893836V6.25685C21.75 6.7574 21.3513 7.15068 20.8438 7.15068ZM28.0938 10.726H0.90625C0.39875 10.726 0 10.3327 0 9.83219C0 9.33164 0.39875 8.93836 0.90625 8.93836H28.0938C28.6013 8.93836 29 9.33164 29 9.83219C29 10.3327 28.6013 10.726 28.0938 10.726Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <p>Horario</p>
        </a>
        <a href="muro.php" class="nav-item" data-page="muro">
            <span>
                <span>
                    <svg width="10" height="10" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.2757 8.01471H22.0441M22.0441 15.0294H13.2757M22.0441 22.0441H13.2757M4.50735 29.0588H25.5515C26.4817 29.0588 27.3738 28.6893 28.0315 28.0315C28.6893 27.3738 29.0588 26.4817 29.0588 25.5515V4.50735C29.0588 3.57714 28.6893 2.68504 28.0315 2.02728C27.3738 1.36952 26.4817 1 25.5515 1H4.50735C3.57714 1 2.68504 1.36952 2.02728 2.02728C1.36952 2.68504 1 3.57714 1 4.50735V25.5515C1 26.4817 1.36952 27.3738 2.02728 28.0315C2.68504 28.6893 3.57714 29.0588 4.50735 29.0588Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
            </span> 
            </span>
            <p>Muro</p>
        </a>
        <a href="tutorias.html" class="nav-item" data-page="tutorias">
            <span>👥</span>
            <p>Tutorías</p>
        </a>
        <a href="bienestar.html" class="nav-item" data-page="bienestar">
            <span>
                <svg width="15" height="15" viewBox="0 0 31 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.0153 2C18.2118 2 15.5098 5.90899 15.5098 7.86275C15.5098 5.90899 12.8078 2 8.00436 2C3.20087 2 2 5.90899 2 7.86275C2 18.1225 15.5098 25.451 15.5098 25.451C15.5098 25.451 29.0196 18.1225 29.0196 7.86275C29.0196 5.90899 27.8187 2 23.0153 2Z" stroke="white" stroke-width="2.33" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                            
            </span>
            <p>Bienestar</p>
        </a>
    </nav>
    </div>
    <div class="containerEmpty"></div>
  </div>
  <script src="JS/main.js"></script>
  <script src="JS/muro.js"></script>
</body>
</html>
