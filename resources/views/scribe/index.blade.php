<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">GET api/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-register">
                                <a href="#endpoints-POSTapi-auth-register">Registrar un nuevo usuario y generar API Key.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-login">
                                <a href="#endpoints-POSTapi-auth-login">Iniciar sesión y obtener API Key.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-regenerate-api-key">
                                <a href="#endpoints-POSTapi-auth-regenerate-api-key">Regenerar API Key para el usuario autenticado.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-restaurants">
                                <a href="#endpoints-GETapi-restaurants">Mostrar un listado de todos los restaurantes.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-restaurants--id-">
                                <a href="#endpoints-GETapi-restaurants--id-">Mostrar el restaurante especificado.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-restaurants">
                                <a href="#endpoints-POSTapi-restaurants">Almacenar un nuevo restaurante en la base de datos.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-restaurants--id-">
                                <a href="#endpoints-PUTapi-restaurants--id-">Actualizar el restaurante especificado en la base de datos.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-restaurants--id-">
                                <a href="#endpoints-DELETEapi-restaurants--id-">Eliminar el restaurante especificado de la base de datos.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: July 21, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include a <strong><code>X-API-KEY</code></strong> header with the value <strong><code>"{YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Puedes obtener tu API Key al registrarte o iniciar sesión en la API usando los endpoints de autenticación.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
access-control-allow-methods: GET, POST, PUT, PATCH, DELETE, OPTIONS
access-control-allow-headers: Content-Type, Authorization, X-Requested-With, X-API-KEY, Accept, Origin
access-control-allow-credentials: true
access-control-max-age: 86400
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;API Key inv&aacute;lida&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="GETapi-user"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-auth-register">Registrar un nuevo usuario y generar API Key.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/auth/register" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"email\": \"kunde.eloisa@example.com\",
    \"password\": \"4[*UyPJ\\\"}6\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/auth/register"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "email": "kunde.eloisa@example.com",
    "password": "4[*UyPJ\"}6"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-register">
</span>
<span id="execution-results-POSTapi-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-register" data-method="POST"
      data-path="api/auth/register"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-register"
                    onclick="tryItOut('POSTapi-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-register"
                    onclick="cancelTryOut('POSTapi-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="POSTapi-auth-register"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-auth-register"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-register"
               value="kunde.eloisa@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>kunde.eloisa@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-register"
               value="4[*UyPJ"}6"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>4[*UyPJ"}6</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-login">Iniciar sesión y obtener API Key.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/auth/login" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"password\": \"O[2UZ5ij-e\\/dl4m{o,\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/auth/login"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com",
    "password": "O[2UZ5ij-e\/dl4m{o,"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-login">
</span>
<span id="execution-results-POSTapi-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-login" data-method="POST"
      data-path="api/auth/login"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-login"
                    onclick="tryItOut('POSTapi-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-login"
                    onclick="cancelTryOut('POSTapi-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="POSTapi-auth-login"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-login"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-login"
               value="O[2UZ5ij-e/dl4m{o,"
               data-component="body">
    <br>
<p>Example: <code>O[2UZ5ij-e/dl4m{o,</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-regenerate-api-key">Regenerar API Key para el usuario autenticado.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-auth-regenerate-api-key">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/auth/regenerate-api-key" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/auth/regenerate-api-key"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-regenerate-api-key">
</span>
<span id="execution-results-POSTapi-auth-regenerate-api-key" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-regenerate-api-key"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-regenerate-api-key"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-regenerate-api-key" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-regenerate-api-key">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-regenerate-api-key" data-method="POST"
      data-path="api/auth/regenerate-api-key"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-regenerate-api-key', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-regenerate-api-key"
                    onclick="tryItOut('POSTapi-auth-regenerate-api-key');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-regenerate-api-key"
                    onclick="cancelTryOut('POSTapi-auth-regenerate-api-key');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-regenerate-api-key"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/regenerate-api-key</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="POSTapi-auth-regenerate-api-key"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-regenerate-api-key"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-regenerate-api-key"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-restaurants">Mostrar un listado de todos los restaurantes.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-restaurants">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/restaurants" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/restaurants"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-restaurants">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
access-control-allow-methods: GET, POST, PUT, PATCH, DELETE, OPTIONS
access-control-allow-headers: Content-Type, Authorization, X-Requested-With, X-API-KEY, Accept, Origin
access-control-allow-credentials: true
access-control-max-age: 86400
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Hickle, Treutel and Hahn&quot;,
            &quot;address&quot;: &quot;76720 Weissnat Ford\nSouth Dalton, ND 92181&quot;,
            &quot;phone&quot;: &quot;407-831-0068&quot;,
            &quot;email&quot;: &quot;myrtis43@example.net&quot;,
            &quot;description&quot;: &quot;Et culpa ad veritatis et et iusto eum. Sapiente placeat debitis totam totam ratione. Nesciunt ut debitis perferendis ut at ab. Assumenda quo autem similique dolores autem corporis omnis.&quot;,
            &quot;cuisine_type&quot;: &quot;India&quot;,
            &quot;rating&quot;: &quot;3.8&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Davis-Vandervort&quot;,
            &quot;address&quot;: &quot;19963 Wintheiser Rest\nJermeyport, AL 40048&quot;,
            &quot;phone&quot;: &quot;(419) 673-6629&quot;,
            &quot;email&quot;: &quot;bailee40@example.net&quot;,
            &quot;description&quot;: &quot;Nihil facere occaecati dolore perferendis recusandae. Rerum aut quo doloremque. Vero voluptatem voluptatum doloribus est veritatis voluptates corrupti accusantium. Vitae eum vel atque praesentium corporis. Est corporis quaerat sunt tenetur saepe at distinctio aut.&quot;,
            &quot;cuisine_type&quot;: &quot;Francesa&quot;,
            &quot;rating&quot;: &quot;4.1&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Kuhlman-Kovacek&quot;,
            &quot;address&quot;: &quot;41328 Kris Causeway Apt. 085\nNorth Adalbertotown, IA 73612-6080&quot;,
            &quot;phone&quot;: &quot;+1 (352) 660-7154&quot;,
            &quot;email&quot;: &quot;arnold.durgan@example.org&quot;,
            &quot;description&quot;: &quot;Tempora non distinctio quidem debitis quia voluptatem quis neque. Necessitatibus assumenda sit ea maxime at sit voluptatem. Omnis occaecati dignissimos et qui qui consequatur. Assumenda tempora doloribus nam sunt amet.&quot;,
            &quot;cuisine_type&quot;: &quot;Mexicana&quot;,
            &quot;rating&quot;: &quot;3.5&quot;,
            &quot;active&quot;: false,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Hudson-Hansen&quot;,
            &quot;address&quot;: &quot;934 Eddie Meadow\nBaumbachbury, AK 94684-2002&quot;,
            &quot;phone&quot;: &quot;+1-202-865-4761&quot;,
            &quot;email&quot;: &quot;mstrosin@example.com&quot;,
            &quot;description&quot;: &quot;Distinctio quos alias non est. Ratione aspernatur dolore id. Sit possimus ut dicta.&quot;,
            &quot;cuisine_type&quot;: &quot;Americana&quot;,
            &quot;rating&quot;: &quot;2.8&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;name&quot;: &quot;Labadie LLC&quot;,
            &quot;address&quot;: &quot;4045 Kihn Mountains\nPort Ruby, IL 72961-9426&quot;,
            &quot;phone&quot;: &quot;+12395661075&quot;,
            &quot;email&quot;: &quot;cronin.liana@example.net&quot;,
            &quot;description&quot;: &quot;Qui optio numquam rerum facere est quasi animi. Nam odit tenetur quae consectetur aliquam. Tenetur aut repellendus esse ducimus quia. Eos autem unde nemo.&quot;,
            &quot;cuisine_type&quot;: &quot;Mexicana&quot;,
            &quot;rating&quot;: &quot;3.9&quot;,
            &quot;active&quot;: false,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;name&quot;: &quot;Heller-Bogan&quot;,
            &quot;address&quot;: &quot;82225 Francesco Village Suite 051\nDeckowshire, WV 17264&quot;,
            &quot;phone&quot;: &quot;+1-747-795-2430&quot;,
            &quot;email&quot;: &quot;lbode@example.org&quot;,
            &quot;description&quot;: &quot;Exercitationem fugiat dolores qui odio iusto rerum a est. Voluptatem natus vel at temporibus unde velit. Enim amet et eos possimus neque. Provident cumque quo dolores laborum id aliquam corrupti.&quot;,
            &quot;cuisine_type&quot;: &quot;Francesa&quot;,
            &quot;rating&quot;: &quot;3.8&quot;,
            &quot;active&quot;: false,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;name&quot;: &quot;Dickens Group&quot;,
            &quot;address&quot;: &quot;307 Kilback Courts\nNelsonborough, ME 66791&quot;,
            &quot;phone&quot;: &quot;1-775-436-3988&quot;,
            &quot;email&quot;: &quot;eward@example.com&quot;,
            &quot;description&quot;: &quot;Aut ut modi omnis suscipit ut. Cupiditate aspernatur occaecati blanditiis occaecati ducimus. Ex facere ipsam autem veritatis.&quot;,
            &quot;cuisine_type&quot;: &quot;Francesa&quot;,
            &quot;rating&quot;: &quot;4.9&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;name&quot;: &quot;Brekke, Bogan and Hansen&quot;,
            &quot;address&quot;: &quot;89867 Haag Tunnel\nAlessandroton, MO 91299&quot;,
            &quot;phone&quot;: &quot;(334) 953-6715&quot;,
            &quot;email&quot;: &quot;pagac.marilyne@example.net&quot;,
            &quot;description&quot;: &quot;Dolor ex nam cupiditate accusamus. Quis necessitatibus totam dolor laudantium. Dolor dolores autem quas accusamus necessitatibus maxime aspernatur.&quot;,
            &quot;cuisine_type&quot;: &quot;Francesa&quot;,
            &quot;rating&quot;: &quot;3.5&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 11,
            &quot;name&quot;: &quot;Brakus-Reichert&quot;,
            &quot;address&quot;: &quot;37180 Huels Tunnel\nSelmerborough, NV 90209-8880&quot;,
            &quot;phone&quot;: &quot;(872) 202-3960&quot;,
            &quot;email&quot;: &quot;adrain99@example.com&quot;,
            &quot;description&quot;: &quot;Consequatur officia beatae sint soluta reprehenderit veritatis. Eum eos et laborum et quasi aut et. Sequi ab culpa atque iusto.&quot;,
            &quot;cuisine_type&quot;: &quot;Japonesa&quot;,
            &quot;rating&quot;: &quot;3.6&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 12,
            &quot;name&quot;: &quot;Boyer, Kovacek and Ortiz&quot;,
            &quot;address&quot;: &quot;4701 Bailey Views Apt. 073\nCorkeryfurt, CT 15293-8302&quot;,
            &quot;phone&quot;: &quot;1-314-348-0821&quot;,
            &quot;email&quot;: &quot;kunze.abby@example.net&quot;,
            &quot;description&quot;: &quot;Et error maiores dolorem nesciunt officiis nostrum. Magnam ut et rem in. Adipisci et amet quo asperiores veritatis. Sequi recusandae nesciunt beatae.&quot;,
            &quot;cuisine_type&quot;: &quot;Japonesa&quot;,
            &quot;rating&quot;: &quot;1.0&quot;,
            &quot;active&quot;: false,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 13,
            &quot;name&quot;: &quot;Keebler, Douglas and Ryan&quot;,
            &quot;address&quot;: &quot;36779 Gutkowski Plains Apt. 725\nClarissaville, VT 59558-9981&quot;,
            &quot;phone&quot;: &quot;585-747-9233&quot;,
            &quot;email&quot;: &quot;mfeeney@example.org&quot;,
            &quot;description&quot;: &quot;Eveniet ut facere nobis doloremque. Voluptatibus laudantium magnam neque quia. Iste qui iste veritatis repellat voluptatem est enim. Sed quos aut ut.&quot;,
            &quot;cuisine_type&quot;: &quot;India&quot;,
            &quot;rating&quot;: &quot;1.7&quot;,
            &quot;active&quot;: false,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;name&quot;: &quot;Dach Group&quot;,
            &quot;address&quot;: &quot;2228 Winston Run\nWest Haskell, NY 01683-9113&quot;,
            &quot;phone&quot;: &quot;+15678973552&quot;,
            &quot;email&quot;: &quot;rolfson.milton@example.org&quot;,
            &quot;description&quot;: &quot;Ratione quibusdam delectus voluptatum repellat molestias exercitationem. Aliquid adipisci velit ipsam eos accusamus fuga. Omnis dignissimos est et sint sit dolor quia quo. Perferendis iste dolores inventore velit.&quot;,
            &quot;cuisine_type&quot;: &quot;Italiana&quot;,
            &quot;rating&quot;: &quot;2.3&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;name&quot;: &quot;Homenick-Watsica&quot;,
            &quot;address&quot;: &quot;8850 Annie Green\nEast Julienchester, SD 13525&quot;,
            &quot;phone&quot;: &quot;+1.765.206.8056&quot;,
            &quot;email&quot;: &quot;cbrakus@example.net&quot;,
            &quot;description&quot;: &quot;Laudantium et laudantium et. Sint et et a ut esse.&quot;,
            &quot;cuisine_type&quot;: &quot;Mexicana&quot;,
            &quot;rating&quot;: &quot;1.6&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;name&quot;: &quot;Sporer, Schuppe and Grimes&quot;,
            &quot;address&quot;: &quot;715 Oral Estates Suite 633\nGriffinview, VT 81367&quot;,
            &quot;phone&quot;: &quot;+1-845-826-1917&quot;,
            &quot;email&quot;: &quot;nicole89@example.net&quot;,
            &quot;description&quot;: &quot;Quod quos enim qui numquam quia. Occaecati fugiat eos laborum. Odio et eligendi qui voluptate.&quot;,
            &quot;cuisine_type&quot;: &quot;China&quot;,
            &quot;rating&quot;: &quot;2.6&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;name&quot;: &quot;Hackett and Sons&quot;,
            &quot;address&quot;: &quot;4095 Donnelly Pike\nChasityshire, IA 83862-8746&quot;,
            &quot;phone&quot;: &quot;+1 (217) 392-8757&quot;,
            &quot;email&quot;: &quot;reid.kuhic@example.com&quot;,
            &quot;description&quot;: &quot;Possimus pariatur rem vel ea ut omnis debitis. Iure voluptatibus praesentium recusandae totam. Est consectetur eum doloremque neque maxime.&quot;,
            &quot;cuisine_type&quot;: &quot;India&quot;,
            &quot;rating&quot;: &quot;1.9&quot;,
            &quot;active&quot;: false,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 18,
            &quot;name&quot;: &quot;Kiehn, Schoen and Baumbach&quot;,
            &quot;address&quot;: &quot;181 Elenora Way\nJuniormouth, MT 27985-0944&quot;,
            &quot;phone&quot;: &quot;1-845-532-7489&quot;,
            &quot;email&quot;: &quot;janie81@example.net&quot;,
            &quot;description&quot;: &quot;Consequuntur repellat doloribus eligendi quibusdam dolor aut amet provident. Vel ratione doloribus quo sint. Sint totam quis beatae et.&quot;,
            &quot;cuisine_type&quot;: &quot;Francesa&quot;,
            &quot;rating&quot;: &quot;3.7&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 19,
            &quot;name&quot;: &quot;Krajcik PLC&quot;,
            &quot;address&quot;: &quot;64106 Maria Locks Suite 803\nRoyalfurt, RI 35697&quot;,
            &quot;phone&quot;: &quot;+1 (938) 200-7353&quot;,
            &quot;email&quot;: &quot;balistreri.levi@example.com&quot;,
            &quot;description&quot;: &quot;Sint sunt qui ex temporibus sint molestiae. Et deleniti architecto consectetur id. Alias ipsum temporibus provident dolores non eos. Facilis dolore magnam perspiciatis expedita.&quot;,
            &quot;cuisine_type&quot;: &quot;Japonesa&quot;,
            &quot;rating&quot;: &quot;4.4&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 20,
            &quot;name&quot;: &quot;Rice and Sons&quot;,
            &quot;address&quot;: &quot;998 Rogahn Fall\nMichealbury, AL 39754&quot;,
            &quot;phone&quot;: &quot;+1 (414) 665-9098&quot;,
            &quot;email&quot;: &quot;thomas70@example.com&quot;,
            &quot;description&quot;: &quot;Consequuntur itaque odio repellendus aut quo tempore necessitatibus. Assumenda est voluptas dolor cum qui ipsa voluptatem. Unde excepturi quisquam totam quam atque. Quis fugiat temporibus eveniet.&quot;,
            &quot;cuisine_type&quot;: &quot;Americana&quot;,
            &quot;rating&quot;: &quot;1.1&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
        },
        {
            &quot;id&quot;: 21,
            &quot;name&quot;: &quot;Restaurante Actualizado&quot;,
            &quot;address&quot;: &quot;Nueva Direcci&oacute;n 456&quot;,
            &quot;phone&quot;: &quot;+34 698765432&quot;,
            &quot;email&quot;: &quot;nuevo@restauranteejemplo.com&quot;,
            &quot;description&quot;: &quot;Descripci&oacute;n actualizada del restaurante&quot;,
            &quot;cuisine_type&quot;: &quot;Italiana&quot;,
            &quot;rating&quot;: &quot;4.8&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2025-07-20T23:12:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-07-20T23:13:42.000000Z&quot;
        }
    ],
    &quot;message&quot;: &quot;Restaurantes recuperados con &eacute;xito&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-restaurants" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-restaurants"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-restaurants"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-restaurants" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-restaurants">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-restaurants" data-method="GET"
      data-path="api/restaurants"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-restaurants', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-restaurants"
                    onclick="tryItOut('GETapi-restaurants');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-restaurants"
                    onclick="cancelTryOut('GETapi-restaurants');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-restaurants"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/restaurants</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="GETapi-restaurants"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-restaurants"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-restaurants"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-restaurants--id-">Mostrar el restaurante especificado.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-restaurants--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/restaurants/2" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/restaurants/2"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-restaurants--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 57
access-control-allow-origin: *
access-control-allow-methods: GET, POST, PUT, PATCH, DELETE, OPTIONS
access-control-allow-headers: Content-Type, Authorization, X-Requested-With, X-API-KEY, Accept, Origin
access-control-allow-credentials: true
access-control-max-age: 86400
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Hickle, Treutel and Hahn&quot;,
        &quot;address&quot;: &quot;76720 Weissnat Ford\nSouth Dalton, ND 92181&quot;,
        &quot;phone&quot;: &quot;407-831-0068&quot;,
        &quot;email&quot;: &quot;myrtis43@example.net&quot;,
        &quot;description&quot;: &quot;Et culpa ad veritatis et et iusto eum. Sapiente placeat debitis totam totam ratione. Nesciunt ut debitis perferendis ut at ab. Assumenda quo autem similique dolores autem corporis omnis.&quot;,
        &quot;cuisine_type&quot;: &quot;India&quot;,
        &quot;rating&quot;: &quot;3.8&quot;,
        &quot;active&quot;: true,
        &quot;created_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-07-20T22:05:53.000000Z&quot;
    },
    &quot;message&quot;: &quot;Restaurante recuperado con &eacute;xito&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-restaurants--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-restaurants--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-restaurants--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-restaurants--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-restaurants--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-restaurants--id-" data-method="GET"
      data-path="api/restaurants/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-restaurants--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-restaurants--id-"
                    onclick="tryItOut('GETapi-restaurants--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-restaurants--id-"
                    onclick="cancelTryOut('GETapi-restaurants--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-restaurants--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/restaurants/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="GETapi-restaurants--id-"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-restaurants--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-restaurants--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-restaurants--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the restaurant. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-restaurants">Almacenar un nuevo restaurante en la base de datos.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-restaurants">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/restaurants" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"address\": \"amniihfqcoynlazghdtqt\",
    \"phone\": \"qxbajwbpilpmufinl\",
    \"email\": \"imogene.mante@example.com\",
    \"description\": \"Dolores dolorum amet iste laborum eius est dolor.\",
    \"cuisine_type\": \"dtdsufvyvddqamniihfqc\",
    \"rating\": 3,
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/restaurants"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "address": "amniihfqcoynlazghdtqt",
    "phone": "qxbajwbpilpmufinl",
    "email": "imogene.mante@example.com",
    "description": "Dolores dolorum amet iste laborum eius est dolor.",
    "cuisine_type": "dtdsufvyvddqamniihfqc",
    "rating": 3,
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-restaurants">
</span>
<span id="execution-results-POSTapi-restaurants" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-restaurants"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-restaurants"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-restaurants" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-restaurants">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-restaurants" data-method="POST"
      data-path="api/restaurants"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-restaurants', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-restaurants"
                    onclick="tryItOut('POSTapi-restaurants');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-restaurants"
                    onclick="cancelTryOut('POSTapi-restaurants');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-restaurants"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/restaurants</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="POSTapi-restaurants"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-restaurants"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-restaurants"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-restaurants"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-restaurants"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-restaurants"
               value="qxbajwbpilpmufinl"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>qxbajwbpilpmufinl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-restaurants"
               value="imogene.mante@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>imogene.mante@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-restaurants"
               value="Dolores dolorum amet iste laborum eius est dolor."
               data-component="body">
    <br>
<p>Example: <code>Dolores dolorum amet iste laborum eius est dolor.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cuisine_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="cuisine_type"                data-endpoint="POSTapi-restaurants"
               value="dtdsufvyvddqamniihfqc"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>dtdsufvyvddqamniihfqc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-restaurants"
               value="3"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 5. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-restaurants" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-restaurants"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-restaurants" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-restaurants"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-restaurants--id-">Actualizar el restaurante especificado en la base de datos.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-restaurants--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/restaurants/2" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"address\": \"amniihfqcoynlazghdtqt\",
    \"phone\": \"qxbajwbpilpmufinl\",
    \"email\": \"imogene.mante@example.com\",
    \"description\": \"Dolores dolorum amet iste laborum eius est dolor.\",
    \"cuisine_type\": \"dtdsufvyvddqamniihfqc\",
    \"rating\": 3,
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/restaurants/2"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "address": "amniihfqcoynlazghdtqt",
    "phone": "qxbajwbpilpmufinl",
    "email": "imogene.mante@example.com",
    "description": "Dolores dolorum amet iste laborum eius est dolor.",
    "cuisine_type": "dtdsufvyvddqamniihfqc",
    "rating": 3,
    "active": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-restaurants--id-">
</span>
<span id="execution-results-PUTapi-restaurants--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-restaurants--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-restaurants--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-restaurants--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-restaurants--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-restaurants--id-" data-method="PUT"
      data-path="api/restaurants/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-restaurants--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-restaurants--id-"
                    onclick="tryItOut('PUTapi-restaurants--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-restaurants--id-"
                    onclick="cancelTryOut('PUTapi-restaurants--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-restaurants--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/restaurants/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="PUTapi-restaurants--id-"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-restaurants--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-restaurants--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-restaurants--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the restaurant. Example: <code>2</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-restaurants--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-restaurants--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-restaurants--id-"
               value="qxbajwbpilpmufinl"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>qxbajwbpilpmufinl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-restaurants--id-"
               value="imogene.mante@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>imogene.mante@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-restaurants--id-"
               value="Dolores dolorum amet iste laborum eius est dolor."
               data-component="body">
    <br>
<p>Example: <code>Dolores dolorum amet iste laborum eius est dolor.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cuisine_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="cuisine_type"                data-endpoint="PUTapi-restaurants--id-"
               value="dtdsufvyvddqamniihfqc"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>dtdsufvyvddqamniihfqc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="PUTapi-restaurants--id-"
               value="3"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 5. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-restaurants--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-restaurants--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-restaurants--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-restaurants--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-restaurants--id-">Eliminar el restaurante especificado de la base de datos.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-restaurants--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/restaurants/2" \
    --header "X-API-KEY: {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/restaurants/2"
);

const headers = {
    "X-API-KEY": "{YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-restaurants--id-">
</span>
<span id="execution-results-DELETEapi-restaurants--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-restaurants--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-restaurants--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-restaurants--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-restaurants--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-restaurants--id-" data-method="DELETE"
      data-path="api/restaurants/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-restaurants--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-restaurants--id-"
                    onclick="tryItOut('DELETEapi-restaurants--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-restaurants--id-"
                    onclick="cancelTryOut('DELETEapi-restaurants--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-restaurants--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/restaurants/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-API-KEY</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-API-KEY" class="auth-value"               data-endpoint="DELETEapi-restaurants--id-"
               value="{YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>{YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-restaurants--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-restaurants--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-restaurants--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the restaurant. Example: <code>2</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
