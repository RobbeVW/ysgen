# ysgen
Easily generate, save and load project structures on the fly!

# Table of contents
1. [Introduction](https://github.com/glowdemon1/ysgen#introduction)
2. [Quick example](https://github.com/glowdemon1/ysgen#quick-example)
3. [Installation](https://github.com/glowdemon1/ysgen#installation)
4. [Generating structures](https://github.com/glowdemon1/ysgen#generating-structures)
5. [Initializing files with content](https://github.com/glowdemon1/ysgen#initializing-files-with-content)
6. [Saving and re-using templates](https://github.com/glowdemon1/ysgen#saving-and-re-using-templates)

# Introduction
YSGen (Yaml Structure Generator) is a package that allows you to easily generate a scaffolding project structure by using a yaml file to represent the project's structure.

# Quick example
Below you will find a yaml file that represents a project's structure. You may notice that this looks similar to a document tree.
```
index.php:
App:
    Controllers:
        PagesController.php:
        TaskController.php:
    router.php:
Models:
    User.php:
    Post.php:
public:
    css:
    js:
    images:
assets:
    views:
        layout.html:
        pages:
            page.html:
    sass:
        app.sass:
    js:
        app.js:
```

After running the `ysgen generate` command on this file, you will create the actual project structure that is inside that `structure.yml` file:

```
│   index.php
│   structure.yml
│
├───App
│   │   router.php
│   │
│   └───Controllers
│           PagesController.php
│           TaskController.php
│
├───assets
│   ├───js
│   │       app.js
│   │
│   ├───sass
│   │       app.sass
│   │
│   └───views
│       │   layout.html
│       │
│       └───pages
│               page.html
│
├───Models
│       Post.php
│       User.php
│
└───public
    ├───css
    ├───images
    └───js
```

# Installation
1. Choose a location to store this application. In this example I will use `C:/Program Files` as the location.
2. `git clone https://github.com/glowdemon1/ysgen`
3. `cd ysgen`
4. `composer install`
5. Add the ysgen installation path to your system's path variables. `C:/Program Files/ysgen/` in this example.
6. Done.

# Generating structures
To create a new project structure, you must first create a folder and create a file called `structure.yml` inside that folder. The `structure.yml` file represents the projects structure, this file should not be named differently!

You can now edit the `structure.yml` file, see [this](https://github.com/glowdemon1/ysgen#quick-example) for a quick example. If you do not know yaml yet, check [this](http://docs.ansible.com/ansible/YAMLSyntax.html) out, yaml really isn't hard. Yaml works by using indentation, example:
```
App:
    Controllers:
        PagesController.php:
        TaskController.php:
    router.php:
```

- The first line creates an `App` directory. (Note that ALL lines must end with a column ':' unless you want to add content to that file).
- The second line creates a `Controllers` directory inside the `App` directory (notice how the indentation relates to that?).
- The third and fourth line both create a `.php` file inside the `App/Controllers` directory. (To create a file you end the name with an extension, else it will be seen as a folder).
- And finaly the last line creates a `router.php` file inside the `App` directory.

After you have made your `structure.yml` file you can open the command prompt, change the directory to your project's folder and use `ysgen generate`. This will create the project structure for you. You may delete the `structure.yml` file after use, or [save](https://github.com/glowdemon1/ysgen#saving-and-re-using-templates) it.

# Initializing files with content
You can also insert content in files when generating your project structure. Take a look at the example below:
```
index.php: |
    <html>
        <head>
            <title>test</title>
        </head>
        <body>
            <h1>You can also initialize files with content!</h1>
        </body>
    </html>
App:
    Controllers:
        PagesController.php:
        TaskController.php:
    router.php:
```

Simply place a pipe symbol after the filename and start your content on the next line followed by a single level of indentation. Please note that the colon and the pipe must have a space between eachother. See [this post](http://stackoverflow.com/questions/3790454/in-yaml-how-do-i-break-a-string-over-multiple-lines) for more info.


# Saving and re-using templates
`structure.yml` files can be easily saved and re-used later as templates. The files will be stored under the `data` folder in your YSGen installation folder. To save a file: `ysgen save <name>` where `<name>` is the name you want to save this file under. Afterwards you can easily run `ysgen generate <name>` to generate a project structure from a saved template.

# Commands
```
C:\Users\Me\Desktop\test>ysgen
| generate:
| Arguments:    <optional:name>
| Description:  Generates a project's structure, uses saved template if name is specified.
+
| save:
| Arguments:    <name>
| Description:  Save a local structure.yml and make it usable globally.
+
| list:
| Arguments:    <>
| Description:  List all globally available templates.
```
