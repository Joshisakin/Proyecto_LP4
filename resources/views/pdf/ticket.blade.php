<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket de Reservación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .ticket {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
            margin-bottom: 10px;
        }
        .ticket-info {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .route-details {
            margin-bottom: 20px;
        }
        .passenger-info {
            margin-bottom: 20px;
        }
        .price-info {
            text-align: right;
            font-size: 18px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <div class="logo">AmazonRiver</div>
            <p>Ticket de Reservación #{{ $reservation->id }}</p>
        </div>

        <div class="ticket-info">
            <div class="route-details">
                <h3>Detalles de la Ruta</h3>
                <table>
                    <tr>
                        <th>Origen:</th>
                        <td>{{ $reservation->route->origen }}</td>
                        <th>Destino:</th>
                        <td>{{ $reservation->route->destino }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de Salida:</th>
                        <td>{{ $reservation->route->fecha_salida->format('d/m/Y H:i') }}</td>
                        <th>Duración:</th>
                        <td>{{ number_format($reservation->route->duracion, 1) }} horas</td>
                    </tr>
                    <tr>
                        <th>Tipo de Embarcación:</th>
                        <td>{{ $reservation->route->boat_type }}</td>
                        <th>Estado:</th>
                        <td>{{ ucfirst($reservation->estado) }}</td>
                    </tr>
                </table>
            </div>

            <div class="passenger-info">
                <h3>Información del Pasajero</h3>
                <table>
                    <tr>
                        <th>Nombre:</th>
                        <td>{{ $reservation->user->name }}</td>
                        <th>Email:</th>
                        <td>{{ $reservation->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Número de Pasajeros:</th>
                        <td>{{ $reservation->num_pasajeros }}</td>
                        <th>Fecha de Reserva:</th>
                        <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>

            <div class="price-info">
                <strong>Total Pagado:</strong>
                <span style="color: #0066cc; font-size: 20px;">
                    S/ {{ number_format($reservation->total, 2) }}
                </span>
            </div>
        </div>

        <div class="qr-code">
            {!! QrCode::size(100)->generate(route('reservations.show', $reservation->id)) !!}
        </div>

        <div class="footer">
            <p>Este ticket es válido solo con una identificación oficial.</p>
            <p>Para cualquier consulta, contacte con nosotros: info@amazonriver.com</p>
            <p>Generado el {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
