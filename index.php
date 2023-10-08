<!DOCTYPE html>
<html>
  <head>
    <script src="env.js"></script>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="style.css" />
    
    
  </head>
  <body>
    <div class="background">

        <div class="my-row">

            <div class="my-section-1" style="flex-wrap: wrap;">
                

                <button onclick="changeSnippet(0)">Postgres</button>
                <button onclick="onInsert(0)">Insert Postgres</button>
                <button onclick="changeSnippet(1)">MYSQL</button>
                <button onclick="onInsert(1)">Insert Mysql</button>
                    
      

            </div>

            <div class="my-section-2 ">

                <pre class="code-block">
                    <code class="code language-php" id="codeSnippet" style="color: yellow;">
&lt;?php
// Your PHP code goes here
$variable = "Hello, World!";
echo $variable;
?&gt;

                    </code>
                </pre>

            </div>

        </div>

        <div class="my-row">

            <div class="my-section-1">

                <pre class="code-block">
                    <code class="code language-php" style="color: #00FF33" id="output2">
&lt;?php
// Your PHP code goes here
$variable = "Hello, World!";
echo $variable;
?&gt;
                    </code>
                </pre>

            </div>

            <div class="my-section-2">

                <div class="output-data-container" id="output"></div>

            </div>

        </div>
    
    </div>
  </body>
</html>
