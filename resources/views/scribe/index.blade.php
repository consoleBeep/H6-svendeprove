<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Mindesten API Documentation</title>

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
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.11.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.11.0.js") }}"></script>

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
                    <ul id="tocify-header-memorial-pages" class="tocify-header">
                <li class="tocify-item level-1" data-unique="memorial-pages">
                    <a href="#memorial-pages">Memorial pages</a>
                </li>
                                    <ul id="tocify-subheader-memorial-pages" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="memorial-pages-GETapi-memorial-pages">
                                <a href="#memorial-pages-GETapi-memorial-pages">List memorial pages</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="memorial-pages-GETapi-memorial-pages--memorialPage_id-">
                                <a href="#memorial-pages-GETapi-memorial-pages--memorialPage_id-">Get a memorial page</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="memorial-pages-GETapi-memorial-pages--memorialPage_id--memories">
                                <a href="#memorial-pages-GETapi-memorial-pages--memorialPage_id--memories">List memories for a memorial page</a>
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
        <li>Last updated: September 23, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="memorial-pages">Memorial pages</h1>

    <p>A read-only API for listing memorial pages and their memories.</p>

                                <h2 id="memorial-pages-GETapi-memorial-pages">List memorial pages</h2>

<p>
</p>

<p>Returns a paginated list of all memorial pages, ordered alphabetically by name.</p>

<span id="example-requests-GETapi-memorial-pages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/memorial-pages" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/memorial-pages"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-memorial-pages">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;full_name&quot;: &quot;Henriette Ebert I&quot;,
            &quot;birth_date&quot;: &quot;1940-08-03&quot;,
            &quot;birth_place&quot;: &quot;West Majorview&quot;,
            &quot;death_date&quot;: &quot;1987-08-29&quot;,
            &quot;death_place&quot;: &quot;Zboncakburgh&quot;,
            &quot;grave_location&quot;: &quot;Vestre Kirkeg&aring;rd, West Majorview&quot;,
            &quot;life_story&quot;: &quot;Sed eos ut rem officia repellendus. Hic officiis corporis qui quo quaerat non hic.\n\nEveniet molestiae corrupti illum error consectetur. Quos reiciendis odio dolore ipsum. Facilis facere totam aspernatur voluptate autem et odio et. Odit autem est quisquam quis.\n\nQuibusdam suscipit ut ipsa est et. Qui architecto maxime natus ipsa dolores architecto qui. Ut vel repudiandae illo id. Sunt dolorem soluta quia debitis.&quot;,
            &quot;portrait_url&quot;: null,
            &quot;url&quot;: &quot;http://localhost:8000/memorial-pages/2&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;full_name&quot;: &quot;Jakob Farrell&quot;,
            &quot;birth_date&quot;: &quot;1932-08-10&quot;,
            &quot;birth_place&quot;: &quot;Lake Isaiburgh&quot;,
            &quot;death_date&quot;: &quot;1962-10-08&quot;,
            &quot;death_place&quot;: &quot;Strosinview&quot;,
            &quot;grave_location&quot;: &quot;&Oslash;stre Kirkeg&aring;rd, Lake Isaiburgh&quot;,
            &quot;life_story&quot;: &quot;Esse velit impedit culpa alias nulla unde qui. Quo veritatis et tempora voluptas suscipit minus rerum. Dicta amet sed doloremque ut qui eum. Assumenda numquam error aut voluptatem voluptas impedit.\n\nMinima nam suscipit totam et. Eos voluptas qui velit deleniti non quam quisquam. Non maxime eligendi asperiores.\n\nRecusandae possimus doloremque cumque ut consequuntur qui. Rerum laborum deserunt quas quam. Sint eaque sint molestiae quidem veniam in accusantium. Commodi sunt veniam alias ad et.&quot;,
            &quot;portrait_url&quot;: null,
            &quot;url&quot;: &quot;http://localhost:8000/memorial-pages/1&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;full_name&quot;: &quot;Mr. Michael Ondricka I&quot;,
            &quot;birth_date&quot;: &quot;1959-08-29&quot;,
            &quot;birth_place&quot;: &quot;Boscostad&quot;,
            &quot;death_date&quot;: &quot;1974-10-19&quot;,
            &quot;death_place&quot;: &quot;Port Mariane&quot;,
            &quot;grave_location&quot;: &quot;Assistens Kirkeg&aring;rd, Boscostad&quot;,
            &quot;life_story&quot;: &quot;Sequi velit eos est fuga numquam doloremque corrupti. Iure cum sit alias et quasi. Et culpa unde aspernatur quo fuga autem. Dolor molestiae voluptate aut et aspernatur quos illo.\n\nRepellendus laboriosam et distinctio rerum accusantium omnis. Et et odit eum vel. Aperiam recusandae accusantium facere consectetur adipisci nulla. Eius autem asperiores repellat doloremque et accusamus. Sequi omnis maiores minima alias molestiae aliquid.\n\nPerferendis quod inventore voluptatem occaecati. Fugit animi occaecati totam nihil iste aut quos.&quot;,
            &quot;portrait_url&quot;: null,
            &quot;url&quot;: &quot;http://localhost:8000/memorial-pages/6&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;full_name&quot;: &quot;Orie Jacobson III&quot;,
            &quot;birth_date&quot;: &quot;1954-09-16&quot;,
            &quot;birth_place&quot;: &quot;Beerburgh&quot;,
            &quot;death_date&quot;: &quot;1978-06-23&quot;,
            &quot;death_place&quot;: &quot;Haneton&quot;,
            &quot;grave_location&quot;: &quot;&Oslash;stre Kirkeg&aring;rd, Beerburgh&quot;,
            &quot;life_story&quot;: &quot;Ut ex qui neque nulla. Repellendus labore tempore ut ut doloribus fugiat voluptas. Aspernatur dolores laboriosam suscipit quia modi ut. Totam enim quae aliquam.\n\nEveniet veniam optio quis possimus quo a ex. Laudantium animi expedita voluptas architecto. Voluptas quasi sed est architecto sequi expedita saepe. Soluta doloribus et et nesciunt et eveniet earum.\n\nAut culpa ut possimus dignissimos beatae quaerat rem. Praesentium quia iste qui. Voluptas dolor eum qui praesentium architecto facere molestiae. Officiis suscipit consequatur voluptatem dolor.&quot;,
            &quot;portrait_url&quot;: null,
            &quot;url&quot;: &quot;http://localhost:8000/memorial-pages/5&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;full_name&quot;: &quot;Shawn Eichmann&quot;,
            &quot;birth_date&quot;: &quot;1968-09-06&quot;,
            &quot;birth_place&quot;: &quot;New Whitneyton&quot;,
            &quot;death_date&quot;: &quot;1983-07-15&quot;,
            &quot;death_place&quot;: &quot;Lake Vita&quot;,
            &quot;grave_location&quot;: &quot;Nordre Kirkeg&aring;rd, New Whitneyton&quot;,
            &quot;life_story&quot;: &quot;Enim amet recusandae ut cum odio esse id. Est porro voluptas sapiente autem. Et eum eligendi quia quo ea nostrum animi.\n\nEt voluptates nihil eveniet hic vel qui. In nesciunt quia numquam provident veniam beatae. Ipsum at et tempora voluptas laboriosam possimus. Consequatur dolor eum aut enim exercitationem adipisci.\n\nVoluptas sapiente dignissimos dolorum quis quia consequatur eos earum. Neque quod voluptas aut et quae voluptas. Quaerat et aut ducimus eum minima ipsa.&quot;,
            &quot;portrait_url&quot;: null,
            &quot;url&quot;: &quot;http://localhost:8000/memorial-pages/4&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;full_name&quot;: &quot;Solon Swaniawski&quot;,
            &quot;birth_date&quot;: &quot;1945-07-02&quot;,
            &quot;birth_place&quot;: &quot;Dibbertview&quot;,
            &quot;death_date&quot;: &quot;1984-01-12&quot;,
            &quot;death_place&quot;: &quot;Hirtheburgh&quot;,
            &quot;grave_location&quot;: &quot;Nordre Kirkeg&aring;rd, Dibbertview&quot;,
            &quot;life_story&quot;: &quot;Et veniam qui et suscipit illo sed rerum. Et inventore et magnam quae. Maiores provident non ex itaque possimus accusamus ipsa.\n\nConsequatur maiores mollitia voluptatem voluptatem eius et magni. Et excepturi ut officiis architecto odit iure esse. Cumque iusto pariatur qui sint rerum.\n\nVitae voluptatem dolore in non quaerat aut. Blanditiis tenetur repellat laboriosam eligendi dolores quia.&quot;,
            &quot;portrait_url&quot;: null,
            &quot;url&quot;: &quot;http://localhost:8000/memorial-pages/3&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:8000/api/memorial-pages?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:8000/api/memorial-pages?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/memorial-pages?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:8000/api/memorial-pages&quot;,
        &quot;per_page&quot;: 20,
        &quot;to&quot;: 6,
        &quot;total&quot;: 6
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-memorial-pages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-memorial-pages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-memorial-pages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-memorial-pages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-memorial-pages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-memorial-pages" data-method="GET"
      data-path="api/memorial-pages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-memorial-pages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-memorial-pages"
                    onclick="tryItOut('GETapi-memorial-pages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-memorial-pages"
                    onclick="cancelTryOut('GETapi-memorial-pages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-memorial-pages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/memorial-pages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-memorial-pages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-memorial-pages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="memorial-pages-GETapi-memorial-pages--memorialPage_id-">Get a memorial page</h2>

<p>
</p>

<p>Returns the details of a single memorial page.</p>

<span id="example-requests-GETapi-memorial-pages--memorialPage_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/memorial-pages/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/memorial-pages/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-memorial-pages--memorialPage_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;Jakob Farrell&quot;,
        &quot;birth_date&quot;: &quot;1932-08-10&quot;,
        &quot;birth_place&quot;: &quot;Lake Isaiburgh&quot;,
        &quot;death_date&quot;: &quot;1962-10-08&quot;,
        &quot;death_place&quot;: &quot;Strosinview&quot;,
        &quot;grave_location&quot;: &quot;&Oslash;stre Kirkeg&aring;rd, Lake Isaiburgh&quot;,
        &quot;life_story&quot;: &quot;Esse velit impedit culpa alias nulla unde qui. Quo veritatis et tempora voluptas suscipit minus rerum. Dicta amet sed doloremque ut qui eum. Assumenda numquam error aut voluptatem voluptas impedit.\n\nMinima nam suscipit totam et. Eos voluptas qui velit deleniti non quam quisquam. Non maxime eligendi asperiores.\n\nRecusandae possimus doloremque cumque ut consequuntur qui. Rerum laborum deserunt quas quam. Sint eaque sint molestiae quidem veniam in accusantium. Commodi sunt veniam alias ad et.&quot;,
        &quot;portrait_url&quot;: null,
        &quot;url&quot;: &quot;http://localhost:8000/memorial-pages/1&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-memorial-pages--memorialPage_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-memorial-pages--memorialPage_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-memorial-pages--memorialPage_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-memorial-pages--memorialPage_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-memorial-pages--memorialPage_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-memorial-pages--memorialPage_id-" data-method="GET"
      data-path="api/memorial-pages/{memorialPage_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-memorial-pages--memorialPage_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-memorial-pages--memorialPage_id-"
                    onclick="tryItOut('GETapi-memorial-pages--memorialPage_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-memorial-pages--memorialPage_id-"
                    onclick="cancelTryOut('GETapi-memorial-pages--memorialPage_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-memorial-pages--memorialPage_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/memorial-pages/{memorialPage_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-memorial-pages--memorialPage_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-memorial-pages--memorialPage_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>memorialPage_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="memorialPage_id"                data-endpoint="GETapi-memorial-pages--memorialPage_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the memorialPage. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="memorial-pages-GETapi-memorial-pages--memorialPage_id--memories">List memories for a memorial page</h2>

<p>
</p>

<p>Returns a paginated list of memories shared on a memorial page, newest first.</p>

<span id="example-requests-GETapi-memorial-pages--memorialPage_id--memories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/memorial-pages/1/memories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/memorial-pages/1/memories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-memorial-pages--memorialPage_id--memories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Eos beatae eius in.&quot;,
            &quot;content&quot;: &quot;Ab sint unde praesentium iste voluptates. Quo voluptatibus voluptate aperiam ut velit. Dolore eius beatae illum incidunt velit et. Eligendi rerum non velit quasi omnis.\n\nEos vero sit accusamus alias qui. Molestiae vel dolore quos in et itaque. Totam id laudantium mollitia sit assumenda non odit.&quot;,
            &quot;author&quot;: &quot;Athena Rutherford&quot;,
            &quot;created_at&quot;: &quot;2026-09-22T14:22:23+00:00&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Velit nesciunt atque in.&quot;,
            &quot;content&quot;: &quot;Sit in aut saepe officia sit. Voluptatem molestiae suscipit placeat consequatur. Eum sit aperiam omnis eos quaerat nisi.\n\nPerferendis eius quis ipsum est placeat explicabo dolorem. Accusamus sit voluptatibus facilis eos optio. Vero assumenda et qui expedita temporibus ipsam labore numquam. Sed rem voluptas quo ea consequatur.&quot;,
            &quot;author&quot;: &quot;Simeon Kuphal&quot;,
            &quot;created_at&quot;: &quot;2026-09-22T14:22:23+00:00&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Earum veritatis rerum maxime.&quot;,
            &quot;content&quot;: &quot;A voluptatibus et itaque quae eaque aut consequatur. Unde quod mollitia occaecati reprehenderit alias explicabo. Quia autem cumque autem consequatur minima.\n\nSapiente tenetur ea cum amet adipisci sint consequatur. Ut aut esse velit dolorem unde sit. Dolor exercitationem praesentium et temporibus.&quot;,
            &quot;author&quot;: &quot;Athena Rutherford&quot;,
            &quot;created_at&quot;: &quot;2026-09-22T14:22:23+00:00&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:8000/api/memorial-pages/1/memories?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:8000/api/memorial-pages/1/memories?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/memorial-pages/1/memories?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:8000/api/memorial-pages/1/memories&quot;,
        &quot;per_page&quot;: 20,
        &quot;to&quot;: 3,
        &quot;total&quot;: 3
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-memorial-pages--memorialPage_id--memories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-memorial-pages--memorialPage_id--memories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-memorial-pages--memorialPage_id--memories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-memorial-pages--memorialPage_id--memories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-memorial-pages--memorialPage_id--memories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-memorial-pages--memorialPage_id--memories" data-method="GET"
      data-path="api/memorial-pages/{memorialPage_id}/memories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-memorial-pages--memorialPage_id--memories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-memorial-pages--memorialPage_id--memories"
                    onclick="tryItOut('GETapi-memorial-pages--memorialPage_id--memories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-memorial-pages--memorialPage_id--memories"
                    onclick="cancelTryOut('GETapi-memorial-pages--memorialPage_id--memories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-memorial-pages--memorialPage_id--memories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/memorial-pages/{memorialPage_id}/memories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-memorial-pages--memorialPage_id--memories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-memorial-pages--memorialPage_id--memories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>memorialPage_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="memorialPage_id"                data-endpoint="GETapi-memorial-pages--memorialPage_id--memories"
               value="1"
               data-component="url">
    <br>
<p>The ID of the memorialPage. Example: <code>1</code></p>
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
