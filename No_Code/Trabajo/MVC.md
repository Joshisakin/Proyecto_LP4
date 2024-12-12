# Estructura MVC del Proyecto

## 📱 Models (app/Models/)

- **User.php**
  - Gestión de usuarios y autenticación
  - Relaciones con reservas y pagos
- **Route.php**
  - Gestión de rutas de viaje
  - Horarios y disponibilidad
- **Reservation.php**
  - Reservas de viajes
  - Estados y relaciones con usuarios
- **Payment.php**
  - Gestión de pagos
  - Integración con pasarela de pago
- **Schedule.php**
  - Programación de horarios
  - Relaciones con rutas

## 🎮 Controllers (app/Http/Controllers/)

### Principales

- **RutaController.php**
  - Búsqueda y visualización de rutas
- **ReservationController.php**
  - Gestión de reservas
  - Proceso de reserva
- **PaymentController.php**
  - Procesamiento de pagos
  - Integración con PayPal
- **ContactoController.php**
  - Formulario de contacto
- **ProfileController.php**
  - Gestión de perfil de usuario

### Administrativos

- **AdminDashboardController.php**
  - Panel de control administrativo
- **AdminReportController.php**
  - Generación de reportes
- **Admin/**
  - Controladores específicos para administración

## 👁 Views (resources/views/)

### Páginas Principales

- **welcome.blade.php**
  - Página de inicio
- **dashboard.blade.php**
  - Panel de usuario
- **about.blade.php**
  - Página de información
- **contacto.blade.php**
  - Formulario de contacto

### Secciones

- **auth/**
  - Vistas de autenticación
- **admin/**
  - Interfaces administrativas
- **payments/**
  - Vistas de proceso de pago
- **reservations/**
  - Gestión de reservas
- **rutas/**
  - Listado y detalles de rutas
- **legal/**
  - Términos y privacidad
- **profile/**
  - Gestión de perfil

### Componentes

- **layouts/**
  - Plantillas base
- **components/**
  - Componentes reutilizables
- **errors/**
  - Páginas de error

## 🛠 Servicios Adicionales

### Services (app/Services/)

- Lógica de negocio compleja
- Servicios de integración

### Middleware (app/Http/Middleware/)

- **AdminMiddleware**
  - Control de acceso administrativo
- Autenticación y autorización

### Providers (app/Providers/)

- Configuración de servicios
- Registro de componentes

## 📊 Diagramas de la Estructura MVC

### Diagrama General de la Arquitectura

```mermaid
graph TD
    Cliente((Cliente)) --> |Petición| R[Rutas]
    R --> |Dirige| C[Controladores]
    C --> |Manipula| M[Modelos]
    M --> |Accede| DB[(Base de Datos)]
    C --> |Renderiza| V[Vistas]
    V --> |Respuesta| Cliente

    subgraph Arquitectura MVC
        R
        C
        M
        V
    end
```

### Diagrama Detallado de Componentes

```mermaid
graph TD
    subgraph Modelos
        Usuario[Usuario.php]
        Ruta[Ruta.php]
        Reserva[Reserva.php]
        Pago[Pago.php]
        Horario[Horario.php]
    end

    subgraph Controladores
        RC[ControladorRuta]
        ResC[ControladorReserva]
        PC[ControladorPago]
        CC[ControladorContacto]
        ProfC[ControladorPerfil]
        AdminC[ControladoresAdmin]
    end

    subgraph Vistas
        MainV[Páginas Principales]
        AuthV[Vistas Autenticación]
        AdminV[Vistas Admin]
        CompV[Componentes]
        PayV[Vistas de Pago]
        ResV[Vistas de Reserva]
    end

    Usuario --> |tiene| Reserva
    Ruta --> |tiene| Horario
    Reserva --> |tiene| Pago

    RC --> Ruta
    ResC --> Reserva
    PC --> Pago
    AdminC --> |gestiona| Usuario

    RC --> MainV
    ResC --> ResV
    PC --> PayV
    AdminC --> AdminV
```

### Diagrama de Flujo de Autenticación

```mermaid
sequenceDiagram
    participant U as Usuario
    participant CA as ControladorAuth
    participant M as Middleware
    participant BD as BaseDeDatos
    participant V as Vistas

    U->>CA: Intenta acceder
    CA->>M: Verifica autenticación
    M->>BD: Consulta credenciales
    BD-->>M: Respuesta

    alt Usuario Autenticado
        M-->>CA: Autorizado
        CA->>V: Muestra Panel
        V-->>U: Vista Panel
    else No Autenticado
        M-->>CA: No Autorizado
        CA->>V: Redirige a Inicio Sesión
        V-->>U: Vista Inicio Sesión
    end
```

### Diagrama de Proceso de Reserva

```mermaid
stateDiagram-v2
    [*] --> BuscarRuta
    BuscarRuta --> SeleccionarRuta
    SeleccionarRuta --> VerificarDisponibilidad

    VerificarDisponibilidad --> RealizarReserva: Disponible
    VerificarDisponibilidad --> BuscarRuta: No Disponible

    RealizarReserva --> ProcesarPago
    ProcesarPago --> ConfirmarReserva: Pago Exitoso
    ProcesarPago --> CancelarReserva: Pago Fallido

    ConfirmarReserva --> [*]
    CancelarReserva --> [*]
```
