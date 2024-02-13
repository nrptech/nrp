@component('mail::message')

# Confirmación de Pedido

¡Hola {{ $order->user->name }}!

Gracias por realizar tu pedido con nosotros. Aquí tienes los detalles de tu compra:

**Número de Pedido:** {{ $order->id }}
**Fecha del Pedido:** {{ $order->created_at->format('d/m/Y H:i:s') }}

**Productos en tu Pedido:**
@foreach($order->products as $product)
- **{{ $product->name }}**
  - Cantidad: {{ $product->pivot->quantity }}
  - Precio Unitario: {{ $product->price }}
@endforeach

**Total del Pedido:** {{ $order->invoice->total }}

**Dirección de Envío:**
{{ $order->shipping_address }}

Agradecemos tu confianza en nuestros productos. Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.

¡Gracias!,
El equipo de [Tu Empresa]

@endcomponent