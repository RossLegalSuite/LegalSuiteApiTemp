<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title>LegalSuite API - Documentation</title>
    <meta name="description" content="" />
    <meta name="author" content="ticlekiwi" />
    
    <meta http-equiv="cleartype" content="on" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" href="css/hightlightjs-dark.css" />
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,300i,500|Source+Code+Pro:300"
    rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" media="all" />
    <script>
        hljs.initHighlightingOnLoad();
    </script>
</head>

<body>
    <div class="left-menu">
        <div class="content-logo">
            <img alt="" title="" src="images/logo.png" height="32" />
            <span>API Documentation</span>
        </div>
        <div class="content-menu">
            <ul>
                <li class="scroll-to-link active" data-target="introduction">
                    <a>Introduction</a>
                </li>
                <li class="scroll-to-link" data-target="how-it-works">
                    <a>Getting Started</a>
                </li>
                <li class="scroll-to-link" data-target="select-columns">
                    <a>Selecting&nbsp;Specific&nbsp;Columns</a>
                </li>
                <li class="scroll-to-link" data-target="where-clauses">
                    <a>Where Clauses</a>
                </li>
                <li class="scroll-to-link" data-target="joins">
                    <a>Sql Joins</a>
                </li>
                <li class="scroll-to-link" data-target="orderby-groupby">
                    <a>Order&nbsp;&&nbsp;Group&nbsp;By's</a>
                </li>
                <li class="scroll-to-link" data-target="parameters">
                    <a>Paging & Methods</a>
                </li>
                <li class="scroll-to-link" data-target="methods">
                    <a>HTTP Methods</a>
                </li>
                <li class="scroll-to-link" data-target="headers">
                    <a>HTTP Headers</a>
                </li>
                <li class="scroll-to-link" data-target="routes">
                    <a>Tables and Views</a>
                </li>
                <li class="scroll-to-link" data-target="register">
                    <a>Registering a Client</a>
                </li>
                <li class="scroll-to-link" data-target="register-developer">
                    <a>Registering a Developer</a>
                </li>
                <!-- <li class="scroll-to-link" data-target="login">
                    <a>Logging in</a>
                </li> -->
                <li class="scroll-to-link" data-target="view">
                    <a>Creating SQL Views</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content-page">
        <div class="content-code"></div>
        <div class="content">
            <div class="overflow-hidden content-section" id="content-introduction">
                <h1 style="font-size: 3em; padding-top:60px" id="introduction">Welcome to the LegalSuite API</h1>
                <pre>
                    <h1 style="color:#fff">
                        A simple example of receiving information of a single Matter.
                    </h1>
                    <code class="bash">
                        GET http://api.legalsuiteonline.co.za/matter/71017 
                        'authorization'='your_api_key' 
                    </code>
                </pre>
                
                <pre>
                    <code class="json">
                        Response:
                        
                        {
                            "data": 
                            [
                                {
                                    "recordid": "71017",
                                    "fileref": "0001/0001",
                                    "description": "Kelvin Test",
                                    "clientid": "28787",
                                    "docgenid": "5",
                                    "mattertypeid": "5",
                                    "documentlanguageid": "1",
                                    "employeeid": "69",
                                    ...
                                }
                            ]
                        }
                    </code>
                </pre>
                
                <p style="font-size: 1.2em;">
                    The LegalSuite API is a communcation platform that facilitates third party app developers to access the
                    data from LegalSuite Clients
                </p>
                <p style="font-size: 1.2em;">
                    The API provides programmatic restful
                    access to the LegalSuite clients databases. This access is protected
                    through secure encrypted keys.
                </p>
                <p style="font-size: 1.2em;">
                    This allows access to software applications such as mobile apps,
                    dashboards, management tools and many more, with this information
                    can be made readily accessible to your clients.
                </p>
                <p style="font-size: 1.2em;">
                    The third party app makes API calls to
                    <code>https://api.legalsuiteonline.co.za/</code> using an
                    authorization key.
                </p>
                
                <p>
                    <img alt="" title="" src="images/API Diagram.png" />
                </p>
            </div>

            <div class="overflow-hidden content-section" id="content-how-it-works">
                <h1 id="how-it-works">Getting Started</h1>
                <p>
                    To use this API, you need an <strong>API key</strong>. Please
                    contact us at
                    <a href="mailto:ross@LegalSuite.co.za">ross@LegalSuite.co.za</a>
                    to obtain an Admin API key with which you can use our sandbox
                    environment or connect to registered Clients.
                </p>
                <p>
                    An example of how to connect to the api is by accessing it at
                    <code>http://api.legalsuiteonline.co.za/employee</code>
                    Your unique API Token needs to be send through in the headers as an
                    authorization key.
                </p>
                <p>
                    This will return an all the records from the Employee Table, we
                    recommend using the paging parameters that can be found under 'Query
                    Parameters' to receive smaller result sets.
                </p>
                <p>
                    The LegalSuite API not only boasts full restful functionality allowing you to View, Update, 
                    Create and Delete records securely but also has an object-relational mapper (ORM) functionality 
                    that makes it enjoyable to interact with your database. 
                </p>
                <p>
                    ORM functionality allows for Query Builders. Simpley put, this allows Where Clauses, Joins, 
                    Select Statments and many more Query Parameters to be executed via the API. This gives the consumer of the API
                    ability to execute complex Sql queries.
                </p>
                <p>
                    The API is not only limited to fetching data from Tables but can also view and even create SQL Views.
                </p>
            </div>
            
            <div class="overflow-hidden content-section" id="content-select-columns">
                <h2 id="select-columns">Selecting Specific Columns</h2>
                <pre>
                    <code class="bash">
                        
                        GET http://api.legalsuiteonline.co.za/matter 
                        'authorization'='Bearer your_api_key' 
                        'select[]:Matter.RecordId'
                        'select[]:Matter.FileRef'
                        'select[]:Matter.Description'
                    </code>
                </pre>
                
                <pre>
                    <code class="json">
                        Response:
                        
                        {
                            "data": [
                            {
                                "recordid": "71017",
                                "fileref": "0001/0001",
                                "description": "Kelvin Test"
                            }
                            ]
                        }
                    </code>
                </pre>
                <p>
                    The API returns a default set of columns when retrieving data from a
                    table.
                </p>
                <p>
                    These are often all that are required, but you can specify the
                    columns returned by using select and addselect.
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>select</td>
                            <td>Select specific columns, e.g. fileRef and description</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?select[]=matter.fileRef
                            </td>
                        </tr>
                        <tr>
                            <td>addselect</td>
                            <td>Add additional columns to the default columns</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?addselect=employee.name
                            </td>
                        </tr>
                        <tr>
                            <td>selectraw</td>
                            <td>
                                To be used when you want to use a function within a Select
                            </td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?selectraw=MAX(matter.RecordID)
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p>
                    If you want to add multiple Columns, you may send through an array of Select fields in the URL.
                    This can be done on any of the select field types, an example of this can be found on the right.
                </p>

            </div>

            <div class="overflow-hidden content-section" id="content-where-clauses">
                <h2 id="where-clauses">Where Clauses</h2>
                <pre>
                    <code class="bash">
                        
                        GET http://api.legalsuiteonline.co.za/matter 
                        'authorization'='Bearer your_api_key' 
                        'select[]:Matter.RecordId'
                        'select[]:Matter.FileRef'
                        'select[]:Matter.Description'
                        'where[]:Matter.EmployeeID,=,8'
                        'where[]:Matter.FileRef,like,ACO1%''
                    </code>
                </pre>
                
                <pre>
                    <code class="json">
                        Response:
                        
                        {
                            "data": [
                            {
                                "recordid": "61810",
                                "fileref": "ACO1/0003",
                                "description": "No Description"
                            },
                            {
                                "recordid": "61811",
                                "fileref": "ACO1/0004",
                                "description": "No Description"
                            }
                            ]
                        }
                    </code>
                </pre>
                <p>
                    The API offers multiple types of where clauses that can be used to refine the result set you recieve.
                    The format of these where clauses use the similar formats to each other, it is sent through with your URL Paramaters
                </p>
                <p>
                    The format of any type of where clause will follow this pattern  <code>where=ColumnName,Operator,Value</code>
                    EG <code>https://api.legalsuiteonline.co.za?where=matter.employeeid,=,8</code>
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>where</td>
                            <td>adds a basic sql where clause.</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?where=RecordID,=,17
                            </td>
                        </tr>
                        <tr>
                            <td>orwhere</td>
                            <td>adds a basic sql orWhere clause.</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?orwhere=fileRef,like,1200
                            </td>
                        </tr>
                        <tr>
                            <td>wherein</td>
                            <td>adds a basic sql whereIn clause.</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?wherein=recordId,17,25,32
                            </td>
                        </tr>
                        <tr>
                            <td>wherenull</td>
                            <td>adds a basic sql orWhere clause.</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?wherenull=matter.description
                            </td>
                        </tr>
                        <tr>
                            <td>wherenotin</td>
                            <td>adds a basic sql whereNotIn clause.</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?wherenotin=recordId,17,25,32
                            </td>
                        </tr>
                        <tr>
                            <td>orwhere</td>
                            <td>adds a basic sql orWhere clause.</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?orwhere=fileRef,like,1200
                            </td>
                        </tr>
                        <tr>
                            <td>whereraw</td>
                            <td>
                                To be used when you want to use a function within a where.
                            </td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?whereraw=MAX(Matter.RecordID)
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>
                    To send multiple where clauses in one query we can make use of the URL array feature, and example can be found on the right.
                </p>
            </div>

            <div class="overflow-hidden content-section" id="content-joins">
                <h2 id="joins">Sql Joins</h2>
                <pre>
                    <code class="bash">
                        
                        GET http://api.legalsuiteonline.co.za/favourites 
                        'authorization'='Bearer your_api_key' 
                        'addselect[]:Matter.FileRef'
                        'addselect[]:Employee.Name'
                        'leftjoin[]:Matter,Matter.RecordID,=,Favourites.MatterID'
                        'leftjoin[]:Employee,Employee.RecordID,=,Favourites.EmployeeID'
                        
                    </code>
                </pre>
                
                <pre>
                    <code class="json">
                        Response:
                        
                        {
                            "data": [
                                {
                                    "fileref": "0001/0001",
                                    "name": "Jennifer Daly",
                                    "recordid": "74249",
                                    "matterid": "71017",
                                    "employeeid": "23",
                                    "date": "80460",
                                    "time": "4521774"
                                }
                            ]
                        }
                    </code>
                </pre>
                <p>
                    Inner, Left and Right joins are all supported through the API
                </p>
                <p>
                    Similar to the where clauses, joins follow a specific pattern.
                    
                    <code>JoinType=JoiningTable,JoiningTableColumn,Operator,TableColumn</code>
                        
                </p>
                <p>
                    EG: <code> https://api.legalsuiteonline.co.za/matter?leftjoin=matter,Matter.RecordID,=,Favourites.MatterID</code>
                </p>

                <p>
                    Detailed Exapled can be found below, joins can also be sent through as an array 
                    allowing multiple joins at once, an example of that can be found on the right.
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>join</td>
                            <td>Provides Inner Join functionality</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?join=matter,Matter.RecordID,=,Favourites.MatterID
                            </td>
                        </tr>
                        <tr>
                            <td>leftjoin</td>
                            <td>Provides Left Join functionality</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?leftjoin=matter,Matter.RecordID,=,Favourites.MatterID
                            </td>
                        </tr>
                        <tr>
                            <td>rightjoin</td>
                            <td>Provides Right Join functionality</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?rightjoin=matter,Matter.RecordID,=,Favourites.MatterID
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overflow-hidden content-section" id="content-orderby-groupby">
                <h2 id="orderby-groupby">Order & Group By's</h2>
                <p>
                    The API also allows you to Order by or Group by your result sets, examples of which can be found below.
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>orderby</td>
                            <td>Provides a Sql OrderBy Functionality</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?orderby=matter.fileRef,DESC
                            </td>
                        </tr>
                        <tr>
                            <td>orderbyraw</td>
                            <td>
                                Provides a Sql OrderBy when wanting to use a SQL Function
                            </td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?orderbyraw=MAX(CustomTable.RecordID),DESC
                            </td>
                        </tr>
                        <tr>
                            <td>groupby</td>
                            <td>Provides a Sql GroupBy Clause</td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?groupby=Matter.DateInstructed
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overflow-hidden content-section" id="content-parameters">
                <h2 id="parameters">Paging and Methods</h2>
                <pre>
                    <code class="bash">
                        
                        GET http://api.legalsuiteonline.co.za/favourites 
                        'authorization'='Bearer your_api_key' 
                        'addselect[]:Matter.FileRef'
                        'addselect[]:Employee.Name'
                        'leftjoin[]:Matter,Matter.RecordID,=,Favourites.MatterID'
                        'leftjoin[]:Employee,Employee.RecordID,=,Favourites.EmployeeID'
                        'method:getSql'
                        
                    </code>
                </pre>
                
                <pre>
                    <code class="json">
                        Response:
                        
                        {
                            select [Matter].[FileRef], 
                            [Employee].[Name], [Favourites].* 
                            from [Favourites] 
                            left join [Matter] on [Matter].[RecordID] 
                            = [favourites].[MatterID] 
                            left join [Employee] on [Employee].[RecordID] 
                            = [favourites].[EmployeeID]
                        }
                    </code>
                </pre>
                <p>
                    Paging is a very powerful tool to reduce the size of the result sets you recieve allowing for faster seamless experience.
                </p>
                <p>
                    method:getSql is one of the most powerful methods on the API, by adding this to your query you are able to see the SQL that it 
                    generate, allowing you to test and debug all queries you send through the API. An Example can be found on the right.
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>start</td>
                            <td>
                                The record position to start from Must be used with the length
                                parameter Useful to add paging functionality to the result
                                set,
                            </td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?start=0&length=10
                            </td>
                        </tr>
                        <tr>
                            <td>length</td>
                            <td>
                                How many records to return Must be used with the start
                                parameter
                            </td>
                            <td>
                                https://api.legalsuiteonline.co.za/matter?start=0&length=10
                            </td>
                        </tr>
                        <tr>
                            <td>method:getSql</td>
                            <td>Instead of a results set, returns the SQL Query.</td>
                            <td>https://api.legalsuiteonline.co.za/matter?method:getSql</td>
                        </tr>
                        <tr>
                            <td>method:Count</td>
                            <td>Returns a Count of the result set.</td>
                            <td>https://api.legalsuiteonline.co.za/matter?method:Count</td>
                        </tr>
                        
                        
                        
                        
                    </tbody>
                </table>

            </div>

            <div class="overflow-hidden content-section" id="content-methods">
                <h2 id="methods">HTTP methods</h2>
                <pre><code class="bash">
                    
                    GET http://api.legalsuiteonline.co.za/favourites
                    'authorization'='Bearer your_api_key' 
                    'select[]=Matter.RecordID'
                    'select[]=Matter.FileRef'
                    'select[]=Matter.Description'
                    'select[]=Matter.EmployeeID'
                    'select[]=Matter.DateInstructed'
                    'selectraw[]=MAX(Favourites.RecordID)'
                    'join[]=matter,Matter.RecordID,=,Favourites.MatterID'
                    'where[]=Favourites.EmployeeID,=,1034'
                    'groupby[]=Matter.RecordID'
                    'groupby[]=Matter.FileRef'
                    'groupby[]=Matter.Description'
                    'groupby[]=Matter.EmployeeID'
                    'groupby[]=Matter.DateInstructed'
                    'orderbyraw[]=MAX(Favourites.RecordID),DESC'
                    'method:getSql'
                </code></pre>
                
                <pre><code class="json">
                    Result example :
                    
                    {
                        
                        select 
                        MAX(Favourites.RecordID), 
                        [Matter].[RecordID], 
                        [Matter].[FileRef], 
                        [Matter].[Description], 
                        [Matter].[EmployeeID],
                        [Matter].[DateInstructed] 
                        from [Favourites] 
                        inner join [matter] on [Matter].[RecordID] = [Favourites].[MatterID] 
                        where ([Favourites].[EmployeeID] = 1034) 
                        group by 
                        [Matter].[RecordID], 
                        [Matter].[FileRef], 
                        [Matter].[Description],      
                        [Matter].[EmployeeID], 
                        [Matter].[DateInstructed] 
                        order by MAX(Favourites.RecordID) desc
                        
                    }
                </code></pre>
                <table>
                    <thead>
                        <tr>
                            <th>HTTP method</th>
                            <th>CRUD</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>GET</td>
                            <td>read</td>
                            <td>returns requested data</td>
                        </tr>
                        <tr>
                            <td>POST</td>
                            <td>create</td>
                            <td>creates a new record</td>
                        </tr>
                        <tr>
                            <td>PUT</td>
                            <td>update</td>
                            <td>updates an existing record</td>
                        </tr>
                        <tr>
                            <td>DELETE</td>
                            <td>delete</td>
                            <td>deletes an existing record</td>
                        </tr>
                    </tbody>
                </table>
                <h2>Method Examples</h2>
                <ul>
                    <li>
                        a GET request to <code>/employee/</code> returns a list of
                        employees from table
                    </li>
                    <li>
                        a POST request to <code>/employee/123</code> creates a employee
                        with the ID <code>123</code>
                    </li>
                    <li>
                        a PUT request to <code>/employee/123</code> updates employee
                        <code>123</code>
                    </li>
                    <li>
                        a GET request to <code>/employee/123</code> returns the details of
                        employee <code>123</code>
                    </li>
                    <li>
                        a DELETE request to <code>/employee/123</code> deletes employee
                        <code>123</code>
                    </li>
                </ul>
            </div>

            <div class="overflow-hidden content-section" id="content-headers">
                <h2 id="headers">HTTP Headers</h2>
                
                <table>
                    <thead>
                        <tr>
                            <th>HTTP Headers</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>authorization</td>
                            <td>
                                The API token either given or received when creating a company
                            </td>
                            <td>authorization: Bearer Bxep2fHX2qzh0WI3IFbL...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overflow-hidden content-section" id="content-routes">
                <h2 id="routes">Available Tables and Views</h2>
                <p>
                    All Tables and Views are accessible via the LegalSuite Api, Tables
                    have full CRUD functionality, while views offer read only access.
                    Both host the flexibility of all query parameters.
                </p>
                <p>
                    All tables can be found here :
                    <code>https://api.legalsuiteonline.co.za/TableNameHere</code>
                </p>
                <p>
                    Views are accessed here :
                    <code>https://api.legalsuiteonline.co.za/views/ViewNameHere</code>
                </p>
            </div>

            <div class="overflow-hidden content-section" id="content-register">
                <h2 id="register">Registering</h2>
                
                <p>
                    Clients need to register at  <a>http://api.legalsuiteonline.co.za/register</a> for developers to be able to access their databases.
                </p>
                
                <p>
                    <img alt="" title="" src="images/registerPage.png" />
                </p>
                <p>
                    Once registered, the clients are presented with the following webpage, here they are able to test and save their SQL connection details, as well as manage the access to their database through the API
                </p>
                <p>
                    <img alt="" title="" src="images/managementPage.png" />
                </p>   
                {{-- <pre><code class="bash">
                    
                    POST http://api.legalsuiteonline.co.za/register 
                    'authorization'='Bearer your_api_key' 
                    'companyName=LegalSuiteAPI' 
                    'dbHost=LegalSuite.co.za'
                    'dbPort=1433'
                    'dbDatabase=legalsuiteapi'
                    'dbUser=userName'
                    'dbPassword=Password'
                </code></pre>
                
                <pre><code class="json">
                    Result example :
                    
                    {
                        "success":
                        "ww6LegIiwTTDJkDmKZeQvNrlbPvM...."
                    }
                </code></pre>
                <p>
                    To register a Client on the API their SQL database opened to
                    <code>legalsuiteonline.co.za</code>. A Client can only be registered
                    by using an Admin API Key, a Post can be made to
                    <code
                    >https://api.legalsuiteonline.co.za/test-database-connection</code
                    >
                    with the connection details to test if you are able to connect to
                    the database.
                </p>
                <p>
                    To Register a Post must be sent to :
                    <code>https://api.legalsuiteonline.co.za/register</code>
                    a unique API Key will returned if successful which can then be used
                    to access the clients database.
                </p>
                <p>The Following Parameters are required when registering a client</p>
                <h2 id="methods">Parameters</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>companyName</td>
                            <td>Unique Company Name</td>
                            <td>companyName:LegalSuite Test Client</td>
                        </tr>
                        <tr>
                            <td>dbHost</td>
                            <td>Location of the Clients SQL Server</td>
                            <td>dbHost:LegalSuite.co.za</td>
                        </tr>
                        <tr>
                            <td>dbPort</td>
                            <td>Port which to connect through</td>
                            <td>dbPort:1433</td>
                        </tr>
                        <tr>
                            <td>dbDatabase</td>
                            <td>Schema Name in the Database</td>
                            <td>dbDatabase:TestClient</td>
                        </tr>
                        <tr>
                            <td>dbUser</td>
                            <td>Database User</td>
                            <td>dbUser:sqlUser1</td>
                        </tr>
                        <tr>
                            <td>dbPassword</td>
                            <td>Database Users Password.</td>
                            <td>dbPassword:Password</td>
                        </tr>
                    </tbody>
                </table> --}}
            </div>

            <div class="overflow-hidden content-section" id="content-register-developer">
                <h2 id="register-developer">Registering</h2>
                
                <p>
                    To register as a developer for the API you need to contact <a href="mailto:ross@LegalSuite.co.za">ross@LegalSuite.co.za</a> you will need to send him your <strong>Company Name, Full Name and Email</strong> a random password will be assigned for you.
                </p>
                
                <p>
                    Once registered, you head to the login page with your credentials and login. You will then be given your management page where you can see which clients have given you access or a list of all clients.
                </p>
                
                <p>
                    <img alt="" title="" src="images/developerHome.png" />
                </p>   
                
            </div>

            <!-- <div class="overflow-hidden content-section" id="content-login">
                <h2 id="login">Logging In</h2>
                
                <pre><code class="bash">
                    
                    POST http://api.legalsuiteonline.co.za/login 
                    'authorization'='Bearer your_api_key' 
                    'login=RS' 
                    'format=lsPassword'
                    'companyName=LegalSuite'
                    'appId=Lexa'
                    
                </code></pre>
                
                <pre><code class="json">
                    Result example :
                    
                    {
                        "error":"0"
                    }
                </code></pre>
                <p>
                    The Api 
                    <code
                    >https://api.legalsuiteonline.co.za/test-database-connection</code
                    >
                    with the connection details to test if you are able to connect to
                    the database.
                </p>
                <p>
                    To Register a Post must be sent to :
                    <code>https://api.legalsuiteonline.co.za/register</code>
                    a unique API Key will returned if successful which can then be used
                    to access the clients database.
                </p>
                <p>The Following Parameters are required when registering a client</p>
                <h2 id="methods">Parameters</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>companyName</td>
                            <td>Unique Company Name</td>
                            <td>companyName:LegalSuite Test Client</td>
                        </tr>
                        <tr>
                            <td>dbHost</td>
                            <td>Location of the Clients SQL Server</td>
                            <td>dbHost:LegalSuite.co.za</td>
                        </tr>
                        <tr>
                            <td>dbPort</td>
                            <td>Port which to connect through</td>
                            <td>dbPort:1433</td>
                        </tr>
                        <tr>
                            <td>dbDatabase</td>
                            <td>Schema Name in the Database</td>
                            <td>dbDatabase:TestClient</td>
                        </tr>
                        <tr>
                            <td>dbUser</td>
                            <td>Database User</td>
                            <td>dbUser:sqlUser1</td>
                        </tr>
                        <tr>
                            <td>dbPassword</td>
                            <td>Database Users Password.</td>
                            <td>dbPassword:Password</td>
                        </tr>
                    </tbody>
                </table>
            </div> -->

            <div class="overflow-hidden content-section" id="content-view">
                <h2 id="view">Creating a View</h2>
                <pre><code class="bash">
                    
                    POST http://api.legalsuiteonline.co.za/createview
                    'authorization'='Bearer your_api_key' 
                    'viewName=LegalSuiteBillingView' 
                    'sql=
                    SELECT
                    dbo.MatTran.RecordId, 
                    DATEADD(dd, dbo.MatTran.Date, '28 December 1800') AS TransactionDate,
                    dbo.MatTran.Description AS BillingDescription,
                    dbo.MatTran.MatterId AS MatterRecordId,
                    dbo.MatTran.InvoiceNo,
                    DATEADD(dd, dbo.MatTran.InvoiceDate, '28 December 1800') AS InvoicedDate,
                    dbo.MatTran.Amount, dbo.MatTran.RefType, dbo.MatTran.ReversedFlag, 
                    dbo.Matter.FileRef AS MatterCode, Matter.MatterTypeID AS MatterTypeId,
                    dbo.MatTran.EmployeeID AS MatterEmployeeIntegrationId 
                    FROM
                    dbo.MatTran
                    LEFT OUTER JOIN
                    dbo.Matter on dbo.Matter.RecordID = dbo.MatTran.MatterId
                    WHERE
                    (dbo.MatTran.RefType = 'B' OR dbo.MatTran.RefType = 'C') 
                    AND (dbo.MatTran.InvoiceDate > 0)
                    '
                    
                </code></pre>
                <pre><code class="json">
                    Result example :
                    
                    {
                        "Success":
                        "You may access the view at 
                        api.legalsuiteonline.co.za/view/LexaLegalSuiteBillingView"
                    }
                </code></pre>
                <p>
                    The API facilitates for the creation of SQL Views, this is done by
                    posting the view name and SQL Script to :<code
                    >https://api.legalsuiteonline.co.za/createview</code
                    >
                    the view name given will always be prefixed with your appID. For
                    example <code>viewName:debitOrdersView</code> will become
                    <code>LexadebitOrdersView</code>. This view is then accessible at
                    <code
                    >https://api.legalsuiteonline.co.za/view/LexadebitOrdersView</code
                    >. Please note that a
                    <code>CREATE OR REPLACE VIEW view_name AS</code> method is used when
                    creating views to allow for updating of current views.
                </p>
                <h2 id="methods">Parameters</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Description</th>
                            <th>Example</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>viewName</td>
                            <td>Name of the view to be created</td>
                            <td>viewName:docLogView</td>
                        </tr>
                        <tr>
                            <td>sql</td>
                            <td>The Sql Script</td>
                            <td>sql:select RecordID, Description from Doclog</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    <div class="content-code"></div>
</div>

<style>
    .github-corner:hover .octo-arm {
        animation: octocat-wave 560ms ease-in-out;
    }
    @keyframes octocat-wave {
        0%,
        100% {
            transform: rotate(0);
        }
        20%,
        60% {
            transform: rotate(-25deg);
        }
        40%,
        80% {
            transform: rotate(10deg);
        }
    }
    @media (max-width: 500px) {
        .github-corner:hover .octo-arm {
            animation: none;
        }
        .github-corner .octo-arm {
            animation: octocat-wave 560ms ease-in-out;
        }
    }
</style>
<!-- END Github Corner Ribbon - to remove -->
<script src="js/script.js"></script>
</body>
</html>
