<div class='content'>
  <div class='content-header'>
    <div class="content-header-search">
      <i class="fa fa-search content-header-search-icon" aria-hidden="true"></i>
      <input wire:model="search" class="content-header-search-input" placeholder="Ingresar empleado" type="text" />
    </div>
    <div class="content-header-actions">
      <button class="content-header-actions-btn">
        <i class="fa fa-cloud-download content-header-actions-btn-icon" aria-hidden="true"></i>
        <span>Importar Excel</span>
      </button>
      <button class="content-header-actions-btn">
        <i class="fa fa-cloud-upload content-header-actions-btn-icon" aria-hidden="true"></i>
        <span>Exportar Excel</span>
      </button>
      <button wire:click="$toggle('showModal')" class="content-header-actions-btn">
        <i class="fa fa-download content-header-actions-btn-icon" aria-hidden="true"></i>
        <span>Cargar Datos</span>
      </button>
    </div>
  </div>
  <div class='content-body'>
    <div class="content-body-table">
      <div class="content-body-table-actions">
        <span class="content-body-table-actions-text">Viendo 1 a 30 de 100 empleados</span>
      </div>
      <div class="content-body-table-header">
        <div class="content-body-table-row">
          <div class="content-body-table-row-item">N°</div>
          <div class="content-body-table-row-item">Tipo de doc.</div>
          <div class="content-body-table-row-item">DNI</div>
          <div class="content-body-table-row-item">N° de cuenta</div>
          <div class="content-body-table-row-item">Apellido paterno</div>
          <div class="content-body-table-row-item">Apellido materno</div>
          <div class="content-body-table-row-item">Nombres</div>
          <div class="content-body-table-row-item">Modalidad de contratación</div>
        </div>
      </div>
      <div class="content-body-table-body">
        @foreach($empleados as $empleado)
        <div class="content-body-table-row">
          <div class="content-body-table-row-item">{{$empleado->n}}</div>
          <div class="content-body-table-row-item">{{$empleado->tipdoc}}</div>
          <div class="content-body-table-row-item">{{$empleado->dni}}</div>
          <div class="content-body-table-row-item">{{$empleado->nCuenta}}</div>
          <div class="content-body-table-row-item">{{$empleado->aPaterno}}</div>
          <div class="content-body-table-row-item">{{$empleado->aMaterno}}</div>
          <div class="content-body-table-row-item">{{$empleado->nombres}}</div>
          <div class="content-body-table-row-item">{{$empleado->modContratacion}}</div>
        </div>
        @endforeach
      </div>
      <div class="content-body-table-footer">
        <div class="content-body-table-footer-box">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
        <div class="content-body-table-footer-box">1</div>
        <div class="content-body-table-footer-box">2</div>
        <div class="content-body-table-footer-box">3</div>
        <div class="content-body-table-footer-box">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>
  <div class='content-footer'>
    <button class="content-header-actions-btn">
      <i class="fa fa-refresh content-header-actions-btn-icon" aria-hidden="true"></i>
      <span>Verificar estado de los datos</span>
    </button>
    <button class="content-header-actions-btn">
      <i class="fa fa-database content-header-actions-btn-icon" aria-hidden="true"></i>
      <span>Ver registro de datos</span>
    </button>
  </div>
  <!-- Modal -->
  @if ($showModal)
  <div class="modal">
    <div class="modal-content">
      <div class="modal-content-actions">
        <p class="modal-content-actions-title">Está permitido cargar Archivos Excel y CSV</p>
        <button wire:click="$toggle('showModal')" class="modal-content-actions-cancel" type="submit">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <form class="modal-content-form" wire:submit.prevent="importExcel">
        <input class="modal-content-form-file" type="file" wire:model="excelFile" accept=".xlsx, .csv">
        @error('excelFile') <span class="error">{{ $message }}</span> @enderror
        <button wire:click="$toggle('showModal')" class="modal-content-form-load" type="submit">Cargar</button>
      </form>
      <div class="progress">
        <div class="progress-bar" style="width: {{ $progress }}%"></div>
      </div>
    </div>
  </div>
  @endif
</div>