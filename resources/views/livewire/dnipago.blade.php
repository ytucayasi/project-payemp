<div class='content'>
  <div class='content-header'>
    <div class="content-header-search">
      <i class="fa fa-search content-header-search-icon" aria-hidden="true"></i>
      <input wire:model="search" class="content-header-search-input" placeholder="Ingresar empleado" type="text" />
    </div>
    <div class="content-header-actions">
      <button wire:click="$toggle('showModal')" class="content-header-actions-btn">
        <i class="fa fa-download content-header-actions-btn-icon" aria-hidden="true"></i>
        <span>Cargar Montos</span>
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
          <div class="content-body-table-row-item">DNI</div>
          <div class="content-body-table-row-item">Monto</div>
        </div>
      </div>
      <div class="content-body-table-body">
        @foreach($pagos as $pago)
        <div class="content-body-table-row">
          <div class="content-body-table-row-item">{{$pago->id}}</div>
          <div class="content-body-table-row-item">{{$pago->dni}}</div>
          <div class="content-body-table-row-item">{{$pago->monto}}</div>
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
    <button wire:click="$toggle('showModal2')" class="content-header-actions-btn">
      <i class="fa fa-refresh content-header-actions-btn-icon" aria-hidden="true"></i>
      <span>Procesar datos</span>
    </button>
  </div>
  @if ($showModal2)
  <div class="modal">
    <div class="modal-content modal-content__x2">
      <div class="modal-content-actions">
        <p class="modal-content-actions-title">Datos procesados</p>
        <button wire:click="$toggle('showModal2')" class="modal-content-actions-cancel" type="button">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div>
        <div class="content-body-table">
          <div class="content-body-table-actions">
            <span class="content-body-table-actions-text">Procesando {{count($pagos)}} empleados</span>
          </div>
          <div class="content-body-table-header text-white">
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
            @foreach ($pagos as $pago)
            @php
            $empleado = \App\Models\Empleado::where('dni', $pago->dni)->first();
            @endphp
            @if ($empleado)
            <div class="content-body-table-row">
              <div class="content-body-table-row-item">{{$empleado->id}}</div>
              <div class="content-body-table-row-item">{{$empleado->tipdoc}}</div>
              <div class="content-body-table-row-item">{{$empleado->dni}}</div>
              <div class="content-body-table-row-item">{{$empleado->nCuenta}}</div>
              <div class="content-body-table-row-item">{{$empleado->aPaterno}}</div>
              <div class="content-body-table-row-item">{{$empleado->aMaterno}}</div>
              <div class="content-body-table-row-item">{{$empleado->nombres}}</div>
              <div class="content-body-table-row-item">{{$empleado->modContratacion}}</div>
            </div>
            @endif
            @endforeach
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button wire:click="exportToExcel" class="content-header-actions-btn1">
          <i class="fa fa-cloud-upload content-header-actions-btn-icon" aria-hidden="true"></i>
          <span>Exportar Excel</span>
        </button>
      </div>
    </div>
  </div>
  @endif
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