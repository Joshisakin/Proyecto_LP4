# Diagrama Entidad-Relación de la Base de Datos

## Diagrama ER

```mermaid
erDiagram
    USUARIOS ||--o{ RESERVAS : realiza
    USUARIOS {
        int id PK
        string nombre
        string email UK
        string password
        datetime email_verificado
        string foto_perfil
        boolean es_admin
        boolean activo
        datetime created_at
        datetime updated_at
    }

    RUTAS ||--o{ RESERVAS : tiene
    RUTAS {
        int id PK
        string origen
        string destino
        datetime fecha_salida
        datetime fecha_llegada
        decimal precio
        int capacidad
        decimal duracion
        text descripcion
        boolean estado
        int asientos_disponibles
        string imagen
        string tipo_barco
        datetime created_at
        datetime updated_at
    }

    RESERVAS ||--o{ PAGOS : tiene
    RESERVAS {
        int id PK
        int usuario_id FK
        int ruta_id FK
        datetime fecha_viaje
        int cantidad_pasajeros
        decimal precio_total
        enum estado
        text comentarios
        datetime created_at
        datetime updated_at
    }

    PAGOS {
        int id PK
        int reserva_id FK
        int usuario_id FK
        decimal monto
        string metodo_pago
        string id_transaccion
        enum estado
        datetime created_at
        datetime updated_at
    }

    HORARIOS ||--o{ RUTAS : pertenece
    HORARIOS {
        int id PK
        int ruta_id FK
        time hora_salida
        time hora_llegada
        boolean activo
        datetime created_at
        datetime updated_at
    }
```

## Descripción de Relaciones

1. **USUARIOS - RESERVAS** (1:N)
   
   - Un usuario puede tener múltiples reservas
   - Cada reserva pertenece a un único usuario

2. **RUTAS - RESERVAS** (1:N)
   
   - Una ruta puede tener múltiples reservas
   - Cada reserva está asociada a una única ruta

3. **RESERVAS - PAGOS** (1:N)
   
   - Una reserva puede tener múltiples pagos
   - Cada pago está asociado a una única reserva

4. **RUTAS - HORARIOS** (1:N)
   
   - Una ruta puede tener múltiples horarios
   - Cada horario pertenece a una única ruta

## Notas Adicionales

- La tabla USUARIOS incluye campos para autenticación y gestión de perfiles
- La tabla RUTAS maneja la información de los viajes disponibles
- La tabla RESERVAS gestiona el estado de las reservaciones
- La tabla PAGOS maneja las transacciones financieras
- La tabla HORARIOS gestiona los tiempos de salida y llegada

## Tipos de Datos Especiales

- **enum estado** en RESERVAS: ['pendiente', 'confirmado', 'cancelado']
- **enum estado** en PAGOS: ['pending', 'completed', 'failed', 'refunded']
- **decimal**: Usado para valores monetarios (precio, monto) con 10 dígitos y 2 decimales 
