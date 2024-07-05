  <h1>Laravel Event Management System - Setup Guide</h1>
<p>This guide will walk you through the setup process for this Event Management System project.</p>
    <h2>Requirements</h2>
    <ul>
        <li>PHP >= 8.2</li>
        <li>Composer</li>
        <li>Laravel 11<li>
        <li>MySQL or any other database supported by Laravel</li>
    </ul>
    <h2>Installation Steps</h2>
    <h3>1. Clone the repository</h3>
    <pre><code>git clone https://github.com/theihasan/event-management.git</code></pre>
    <h3>2. Navigate to the project directory</h3>
    <pre><code>cd event-management</code></pre>
    <h3>3. Install dependencies</h3>
    <pre><code>composer install</code></pre>
    <h3>4. Set up environment variables</h3>
    <p>Copy the <code>.env.example</code> file to <code>.env</code> and update the database credentials and other necessary configurations:</p>
    <pre><code>cp .env.example .env</code></pre>
    <h3>5. Generate application key</h3>
    <pre><code>php artisan key:generate</code></pre>
    <h3>6. Run migrations</h3>
    <pre><code>php artisan migrate</code></pre>
    <h3>8. Start the development server</h3>
    <pre><code>php artisan serve</code></pre>
    <p>Your Laravel application should now be running on <code>http://localhost:8000</code>.</p>
    <p> Frontend URL will be <code>http://localhost:3000</code>.</p>
    <h1>Laravel Event Management System - API Documentation</h1>
    <p>This documentation provides an overview of the API endpoints available in this Event Management System.</p>
    <h2>Base URL</h2>
    <p>The base URL for all API endpoints is: <code>http://localhost:8000/api</code></p>
    <h2>Endpoints</h2>
        <h2>Authentication Endpoints</h2>
    <h3>POST /register</h3>
    <p>Register a new user.</p>
    <pre><code>curl -X POST http://localhost:8000/api/register \
    -H "Content-Type: application/json" \
    -d '{
        "name": "John Doe",
        "email": "johndoe@example.com",
        "password": "password",
        "password_confirmation": "password"
    }'</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
    "message": "User registered successfully"
}</code></pre>
    <h3>POST /login</h3>
    <p>Login an existing user.</p>
    <pre><code>
    <h3>GET /api/events</h3>
    <p>Retrieve a list of all events.</p>
    <pre><code>curl -X GET http://localhost:8000/api/events</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
    "data": [
        {
            "id": 1,
            "title": "Event Title",
            "description": "Event Description",
            "date": "2024-07-01",
            "location": "Event Location",
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/events?page=1",
        "last": "http://localhost:8000/api/events?page=10",
        "prev": null,
        "next": "http://localhost:8000/api/events?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 10,
        "path": "http://localhost:8000/api/events",
        "per_page": 10,
        "to": 10,
        "total": 100
    }
}</code></pre>
   <h3>POST /api/events</h3>
    <p>Create a new event.</p>
    <pre><code>curl -X POST http://localhost:8000/api/events \
    -H "Content-Type: application/json" \
    -d '{
        "title": "New Event",
        "description": "Description of the new event",
        "date": "2024-08-01",
        "location": "New Location"
    }'</code></pre>
    <p><strong>Request Data Type:</strong></p>
    <pre><code>{
    "title": "string",
    "description": "string",
    "date": "date",
    "location": "string"
}</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
    "message": "Event created successfully"
}</code></pre>

    <h3>GET /api/events/{id}</h3>
    <p>Retrieve details of a specific event.</p>
    <pre><code>curl -X GET http://localhost:8000/api/events/1</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
    "data": {
        "id": 1,
        "title": "Event Title",
        "description": "Event Description",
        "date": "2024-07-01",
        "location": "Event Location",
    }
}</code></pre>

    <h3>PUT /api/events/{id}</h3>
    <p>Update an existing event.</p>
    <pre><code>curl -X PUT http://localhost:8000/api/events/1 \
    -H "Content-Type: application/json" \
    -d '{
        "title": "Updated Event Title",
        "description": "Updated Description",
        "date": "2024-08-01",
        "location": "Updated Location"
    }'</code></pre>
    <p><strong>Request Data Type:</strong></p>
    <pre><code>{
    "title": "string",
    "description": "string",
    "date": "date",
    "location": "string"
}</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
    "message": "Event updated successfully"
}</code></pre>

    <h3>DELETE /api/events/{id}</h3>
    <p>Delete an event.</p>
    <pre><code>curl -X DELETE http://localhost:8000/api/events/1</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
    "message": "Event deleted successfully"
}</code></pre>
 <h2>Validation Errors</h2>
    <p>When creating or updating an event, the following validation errors might occur:</p>
<ul>
    <li><strong>Title is required</strong>: This validation rule ensures that the <code>title</code> field is not left empty. The user must provide a value for this field.</li>
    <li><strong>Title should not be greater than 255 characters</strong>: This rule limits the length of the <code>title</code> field to a maximum of 255 characters. This prevents excessively long titles that might cause issues in the database or the user interface.</li>
    <li><strong>Title should be a string</strong>: This rule ensures that the value of the <code>title</code> field is a string. It prevents non-string values (such as numbers or arrays) from being accepted.</li>
    <li><strong>Description is required</strong>: This validation rule ensures that the <code>description</code> field is not left empty. The user must provide a value for this field.</li>
    <li><strong>Description should be a string</strong>: This rule ensures that the value of the <code>description</code> field is a string. It prevents non-string values from being accepted.</li>
    <li><strong>Date is required</strong>: This validation rule ensures that the <code>date</code> field is not left empty. The user must provide a value for this field.</li>
    <li><strong>Date should be a valid date</strong>: This rule ensures that the value of the <code>date</code> field is a valid date. It prevents invalid date formats from being accepted.</li>
    <li><strong>Date should be today or in the future</strong>: This rule ensures that the <code>date</code> field is set to a date that is either today or in the future. Past dates are not accepted.</li>
    <li><strong>Location is required</strong>: This validation rule ensures that the <code>location</code> field is not left empty. The user must provide a value for this field.</li>
    <li><strong>Location should be a string</strong>: This rule ensures that the value of the <code>location</code> field is a string. It prevents non-string values from being accepted.</li>
    <li><strong>Location should not be greater than 255 characters</strong>: This rule limits the length of the <code>location</code> field to a maximum of 255 characters. This prevents excessively long location names that might cause issues in the database or the user interface.</li>
</ul>


  