# Documentación Completa de la API - Sistema Infosalud (Gestión de Pacientes Crónicos)

**Versión:** 1.0

**Base URL:** `http://localhost:8000/api`

**Fecha:** Noviembre 2025

---

## Índice

1. [Autenticación](https://www.perplexity.ai/search/actua-como-arquitecto-de-softw-u1j2YV6JTxieMapmlrSE0A#autenticaci%C3%B3n)
2. [Gestión de Pacientes](https://www.perplexity.ai/search/actua-como-arquitecto-de-softw-u1j2YV6JTxieMapmlrSE0A#gesti%C3%B3n-de-pacientes)
3. [Gestión de Citas](https://www.perplexity.ai/search/actua-como-arquitecto-de-softw-u1j2YV6JTxieMapmlrSE0A#gesti%C3%B3n-de-citas)
4. [Historial Clínico](https://www.perplexity.ai/search/actua-como-arquitecto-de-softw-u1j2YV6JTxieMapmlrSE0A#historial-cl%C3%ADnico)
5. [Alertas y Síntomas](https://www.perplexity.ai/search/actua-como-arquitecto-de-softw-u1j2YV6JTxieMapmlrSE0A#alertas-y-s%C3%ADntomas)
6. [Reportes](https://www.perplexity.ai/search/actua-como-arquitecto-de-softw-u1j2YV6JTxieMapmlrSE0A#reportes)
7. [Notificaciones (SMS/WhatsApp)](https://www.perplexity.ai/search/actua-como-arquitecto-de-softw-u1j2YV6JTxieMapmlrSE0A#notificaciones-smswhatsapp)
8. [Testing y Validación](https://www.perplexity.ai/search/actua-como-arquitecto-de-softw-u1j2YV6JTxieMapmlrSE0A#testing-y-validaci%C3%B3n)

---

## Autenticación

## Registro de Usuario

**Endpoint:** `POST /api/register`

**Request Body:**

`json{
  "name": "María García",
  "email": "maria@ejemplo.com",
  "password": "password123",
  "phone": "+573001234567",
  "notification_channel": "sms"
}`

**Response (201 Created):**

`json{
  "user": {
    "id": 1,
    "name": "María García",
    "email": "maria@ejemplo.com",
    "phone": "+573001234567",
    "notification_channel": "sms"
  },
  "token": "1|xyz123abc456..."
}`

## Login

**Endpoint:** `POST /api/login`

**Request Body:**

`json{
  "email": "maria@ejemplo.com",
  "password": "password123"
}`

**Response (200 OK):**

`json{
  "user": { ... },
  "token": "1|xyz123abc456..."
}`

## Obtener Usuario Actual

**Endpoint:** `GET /api/user`

**Headers:**

`textAuthorization: Bearer {token}
Accept: application/json`

**Response (200 OK):**

`json{
  "id": 1,
  "name": "María García",
  "email": "maria@ejemplo.com",
  "phone": "+573001234567",
  "notification_channel": "sms"
}`

---

## Gestión de Pacientes

## Registrar Paciente

**Endpoint:** `POST /api/patients`

**Headers:** `Authorization: Bearer {token}`

**Request Body:**

`json{
  "name": "Carlos Martínez",
  "dob": "1970-05-10",
  "phone": "+573001111111",
  "email": "carlos@ejemplo.com",
  "affiliation_status": "active"
}`

**Response (201 Created):**

`json{
  "id": 1,
  "name": "Carlos Martínez",
  "dob": "1970-05-10",
  "phone": "+573001111111",
  "email": "carlos@ejemplo.com",
  "affiliation_status": "active"
}`

## Actualizar Contacto del Paciente

**Endpoint:** `PUT /api/patients/{id}`

**Request Body:**

`json{
  "phone": "+573001222222",
  "email": "nuevo@ejemplo.com"
}`

## Actualizar Diagnóstico y Tratamiento

**Endpoint:** `PATCH /api/patients/{id}/diagnosis`

**Request Body:**

`json{
  "diagnosis": "Hipertensión arterial estadio 2",
  "treatment_plan": "Medicación diaria, control de presión semanal"
}`

## Ver Detalles del Paciente

**Endpoint:** `GET /api/patients/{id}`

**Response (200 OK):**

`json{
  "id": 1,
  "name": "Carlos Martínez",
  "dob": "1970-05-10",
  "phone": "+573001111111",
  "email": "carlos@ejemplo.com",
  "affiliation_status": "active",
  "diagnosis": "Hipertensión arterial estadio 2",
  "treatment_plan": "Medicación diaria, control de presión semanal"
}`

---

## Gestión de Citas

## Crear Cita

**Endpoint:** `POST /api/appointments`

**Request Body:**

`json{
  "title": "Control Cardiología",
  "description": "Revisión mensual de hipertensión",
  "location": "Consultorio 201",
  "scheduled_at": "2025-11-15T10:00:00"
}`

**Response (201 Created):**

`json{
  "id": 1,
  "user_id": 1,
  "title": "Control Cardiología",
  "description": "Revisión mensual de hipertensión",
  "location": "Consultorio 201",
  "scheduled_at": "2025-11-15T10:00:00",
  "status": "scheduled"
}`

## Listar Citas del Usuario

**Endpoint:** `GET /api/appointments`

## Ver Cita Específica

**Endpoint:** `GET /api/appointments/{id}`

## Actualizar Cita

**Endpoint:** `PUT /api/appointments/{id}`

**Request Body:**

`json{
  "status": "completed",
  "location": "Consultorio 202"
}`

## Eliminar Cita

**Endpoint:** `DELETE /api/appointments/{id}`

**Response (200 OK):**

`json{
  "message": "Cita eliminada exitosamente"
}`

---

## Historial Clínico

## Agregar Registro Clínico

**Endpoint:** `POST /api/patients/{id}/history`

**Request Body:**

`json{
  "doctor_id": 2,
  "symptom_summary": "Dolor de cabeza, mareos",
  "visit_date": "2025-11-05",
  "notes": "Se sugiere resonancia magnética"
}`

**Response (201 Created):**

`json{
  "id": 1,
  "patient_id": 1,
  "doctor_id": 2,
  "symptom_summary": "Dolor de cabeza, mareos",
  "visit_date": "2025-11-05",
  "notes": "Se sugiere resonancia magnética",
  "created_at": "2025-11-05T14:30:00"
}`

## Listar Historial del Paciente

**Endpoint:** `GET /api/patients/{id}/history`

**Response:** Array de registros clínicos ordenados por fecha

## Ver Registro Específico

**Endpoint:** `GET /api/history/{history_id}`

---

## Alertas y Síntomas

## Reportar Síntoma (Genera Alerta Automática)

**Endpoint:** `POST /api/patients/{id}/symptoms`

**Request Body:**

`json{
  "symptom": "Dificultad para respirar"
}`

**Response (201 Created):**

`json{
  "message": "Síntoma reportado y alerta creada exitosamente"
}`

## Listar Alertas del Paciente

**Endpoint:** `GET /api/patients/{id}/alerts`

**Response (200 OK):**

`json[
  {
    "id": 1,
    "type": "symptom-reported",
    "message": "Dificultad para respirar",
    "status": "pending",
    "created_at": "2025-11-05T16:20:00"
  }
]`

---

## Reportes

## Estadísticas de Citas

**Endpoint:** `GET /api/reports/appointments`

**Response (200 OK):**

`json{
  "confirmed": 45,
  "lost": 12
}`

## Adherencia del Paciente

**Endpoint:** `GET /api/reports/patient-adherence/{id}`

**Response (200 OK):**

`json{
  "adherence_rate_percent": 75.0,
  "total_appointments": 4,
  "attended_appointments": 3
}`

---

## Notificaciones (SMS/WhatsApp)

## Enviar SMS de Prueba

**Endpoint:** `POST /api/test/sms`

**Request Body:**

`json{
  "phone": "+573001234567",
  "message": "Recordatorio: Tienes una cita médica mañana a las 10:00 AM"
}`

**Response (200 OK):**

`json{
  "sent": true
}`

**Response (500 Error):**

`json{
  "sent": false
}`

**Notas Importantes:**

- Para cuentas de prueba de Twilio, el número receptor debe estar verificado
- El número debe estar en formato E.164: `+[código país][número]`
- Ejemplo: `+573001234567` para Colombia
- Verifica logs en `storage/logs/laravel.log` si `sent: false`

## Configuración Requerida (.env)

`textTWILIO_SID=ACxxxxxxxxxxxxxxxxx
TWILIO_AUTH_TOKEN=xxxxxxxxxxxxxxxxx
TWILIO_PHONE_NUMBER=+1234567890
TWILIO_WHATSAPP_NUMBER=whatsapp:+14155238886`

---

## Testing y Validación

## Flujo de Prueba Completo en Postman

## 1. Autenticación

`textPOST /api/register
→ Guardar token recibido`

## 2. Crear Paciente

`textPOST /api/patients
Header: Authorization: Bearer {token}`

## 3. Crear Cita

`textPOST /api/appointments
Header: Authorization: Bearer {token}`

## 4. Reportar Síntoma

`textPOST /api/patients/1/symptoms
Header: Authorization: Bearer {token}`

## 5. Verificar Alertas

`textGET /api/patients/1/alerts
Header: Authorization: Bearer {token}`

## 6. Probar Notificación SMS

`textPOST /api/test/sms
Body: {"phone": "+57...", "message": "Test"}
→ Verificar SMS recibido en teléfono`

---

## Códigos de Estado HTTP

- **200 OK:** Solicitud exitosa
- **201 Created:** Recurso creado exitosamente
- **401 Unauthorized:** Token inválido o faltante
- **404 Not Found:** Recurso no encontrado
- **422 Unprocessable Entity:** Error de validación
- **500 Internal Server Error:** Error del servidor

---

## Errores Comunes

## Error 401 - No autorizado

**Causa:** Token no incluido o expirado

**Solución:** Incluir header `Authorization: Bearer {token}`

## Error 422 - Validación

**Causa:** Datos faltantes o formato incorrecto

**Solución:** Revisar campos requeridos y formatos

## SMS no enviado (`sent: false`)

**Causa:** Número no verificado (cuenta trial) o credenciales incorrectas

**Solución:**

1. Verificar número en Twilio Console
2. Revisar `storage/logs/laravel.log`
3. Confirmar credenciales en `.env`

---

## Recursos Adicionales

- **Documentación Laravel:** https://laravel.com/docs/12.x
- **Twilio SMS PHP:** https://www.twilio.com/docs/sms/quickstart/php
- **Postman API Testing:** https://www.twilio.com/en-us/blog/postman-make-requests-test-apis

---

## Contacto y Soporte

Para reportar problemas o solicitar nuevas funcionalidades, contactar al equipo de desarrollo backend.

**Última actualización:** Noviembre 5, 2025

1. https://www.twilio.com/es-mx/blog/como-crear-un-portal-de-sms-con-laravel-y-twilio
2. https://www.twilio.com/es-mx/blog/create-sms-portal-laravel-php-twilio
3. https://www.twilio.com/es-mx/blog/como-enviar-sms-masivos-con-twilio-y-laravel-php
4. https://www.youtube.com/watch?v=9NAx3CByf7c
5. https://www.twilio.com/es-mx/blog/como-crear-un-canal-de-notificacion-en-laravel-para-whatsapp-con-twilio
6. https://www.youtube.com/watch?v=fSgb8LiY2B4
7. https://www.twilio.com/es-mx
8. https://es.fiverr.com/rizwanhaider66/twilio-or-plivo-bulk-sms-in-laravel-framework
9. https://www.labsmobile.com/es/api-sms/versiones-api/http-rest-post-json
10. https://www.back4app.com/docs-es/integracion-de-twilio-api-con-funciones-cloud-para-sms
