@extends('layouts.guest')

@section('content')


<div class="flex-center position-ref">
    <div class="content">
        
        <p>
            <div class="title"><u>LEGALSUITE DATABASE STRUCTURE</u></div>
        </p>
        
        <div class="content-section">
            <p>
                <h1><u>Introduction</u></h1>
            </p>
            <p>
                LegalSuite is a Windows-based program designed to assist attorneys in
                managing their legal practices. It is written in Clarion and .Net and uses
                the MS SQL database to store the program’s data. It also exposes an API to
                allow 3<sup>rd</sup> party programs to access the data. This document
                serves to provide a brief overview of the database structure to assist
                those wanting to access the data from the API.
            </p>
            <p>
                <h1><u>The Matter Table</u></h1>
            </p>
            <p>
                An attorney typically has numerous Clients (stored in the Party table) and
                each Client may have one or more Matters. Most of the information regarding
                a Matter is stored in the Matter table, but additional Matter information
                may also be found in ColData, ConveyData and BondData depending on the type
                of Matter.
            </p>
            <p>
                Every table in LegalSuite has a Primary Key based on an auto-incrementing
                integer called RecordID.
            </p>
            <p>
                The Matter table also has a unique key on the FileRef column (which is the
                how the user typically identifies a Matter from the front end).
            </p>
            <p>
                <strong>SQL:</strong>
                SELECT RecordID, FileRef, Description, ClaimAmount, MatterTypeID FROM
                Matter
            </p>
            <p><img src="/images/dbStructure/Matter.png" style="width: 70%" alt=""></p>
            <p>
                Internally, the Clarion language identifies a table column by a table
                prefix and the column name. In the above example, the five columns are
                referenced as MAT:RecordID, MAT:FileRef, MAT:Description, MAT:ClaimAmount,
                MAT:MatterTypeID in the actual programming code. You can use this internal
                syntax to identify the table and the column name.
            </p>
            <p>
                To find out the table and name of a particular database column, load the
                LegalSuite program and go to the relevant form and hover your cursor over
                an field until the tooltip appears. The table prefix and column name is
                displayed in the last line of the tooltip.
            </p>
            <p><img src="/images/dbStructure/image1.png" alt=""></p>
            <p>
                Figure 1: Tooltips contain the Table Prefix Column name of each field
            </p>
            <p>
                In the above example, MAT:FileRef indicates that this data is stored in the
                Matter (MAT:) table and its column name is FileRef.
            </p>
            <div>
                <p>
                    <strong>Tip</strong>
                    <br/>
                    <br/>
                    To view a complete listing of all the columns in the Matter table, you
                    can use this SQL script
                </p>
                <p>
                    <strong>
                        SELECT Column_Name, Data_Type FROM INFORMATION_SCHEMA.COLUMNS WHERE
                        TABLE_NAME='Matter' ORDER BY Column_Name
                    </strong>
                    
                </p>
                <p>
                    Note: To view other tables, simply replace the word ‘Matter’ with the
                    table name in the above script.
                </p>
            </div>
            <p>
                <h1>
                    <u>
                        <br/>
                        The Party and MatParty Tables
                    </u>
                </h1>
            </p>
            <p>
                All Parties are stored in the Party table.
            </p>
            <p>
                A Client is a <em>Party</em> who plays the role of <em>Client</em> on a
                particular Matter.
            </p>
            <p>
                The Party table also has a unique key on the Codecolumn (which is the how
                the user typically identifies a Party from the front end).
            </p>
            <p>
                <strong>SQL:</strong>
                SELECT RecordID, Code, Name, VatNumber, PartyTypeID FROM Party
            </p>
            <p><img src="/images/dbStructure/Party.png" style="width: 70%" alt=""></p>
            <p>
                Matters typically have a number of Parties (Matter Parties) associated with
                it which represent the Parties involved in the Matter.
            </p>
            <p>
                For example, John Smith may be the Client, Absa Bank may be the Defendant
                and John Smith<em> may also be the Plaintiff</em>. In other words, a Party
                can play more than one <em>role</em> on a Matter.
                <br/>
                <br/>
                The Matter’s Parties are stored in the MatParty table which is a    <em>joining table</em> between the Matter and Party tables.
            </p>
            <p>
                <strong>SQL:</strong>
                SELECT RecordID, MatterID, PartyID, RoleID FROM MatParty WHERE MatterID = 1
            </p>
            <p><img src="/images/dbStructure/MatParty.png" style="width: 70%" alt=""></p>
            <p>
                <br/>
                The RoleId column identifies the <em>role</em> the Party plays on the
                Matter. In the above example, RoleID = 1 is the Client role, RoleID = 2 is
                the Plaintiff role and RoleID = 3 is the Defendant role. Roles are stored
                in the Role table.
            </p>
            <p>
                <strong>SQL:</strong>
                SELECT RecordID, Description FROM Role
            </p>
            <p><img src="/images/dbStructure/Role.png" style="width: 70%" alt=""></p>
            <p>
                <h1><u>Related Tables</u></h1>
            </p>
            <p>
                In a <em>relational database</em>, tables are linked (or related) to each
                other. This is an important concept and vital to understanding the layout
                and relationship of the tables used by the LegalSuite program.
            </p>
            <p>
                The RecordID column is typically hidden from the user’s view and they are
                usually unaware of it. It is very important, however, from a database point
                of view as it serves to:
            </p>
            <p>
                (1) Uniquely identify each record.
                <br/>
                (2) Link related tables to each other.
            </p>
            <p><img src="/images/dbStructure/Matter.png" style="width: 70%" alt=""></p>
            <p>
                In the above example, you will notice that the Matters, FNB1/0003 and
                FNB1/0004, both have the same ClientID (12). That is because these Matters
                both belong to the same Client (in this case, FNB).
            </p>
            <p>
                FNB’s details are <u>not stored </u>in the Matter table – this would be
                highly inefficient because if FNB’s address changed, for example, we would
                have to change their address in every record in the Matter table! In
                database parlance, this is called <em>normalization</em> and LegalSuite
                strictly conforms to database normalization.
            </p>
            <p>
                Instead of storeing FNB’s details in the Matter, we record that these two
                Matter records have a ClientID = 12 and so FNB’s details are stored, once,
                in the Party table (which is called the Address Book from the user’s point
                of view).
            </p>
            <p><img src="/images/dbStructure/Party.png" style="width: 70%" alt=""></p>
            <p>
                You will notice that FNB has a RecordID = 12. This is how the Matter table
                is linked to the Party table: MAT:ClientID (12) = PAR:RecordID (12).
            </p>
            <p><img src="/images/dbStructure/image2.png" alt=""></p>
            <p>
                Figure 2: The Party table is linked to the Matter table via PAR:RecordID =
                MAT:ClientID
            </p>
            <p>
                This is called a <em>many-to-one</em> relationship because many Matters can
                be linked to one Party record (e.g. we could have thousands of Matters with
                a ClientID of 12 but we will only have one Party record with a RecordID of
                12). The Party table is the <em>Parent</em> table and the Matter table in
                this case would be the <em>Child</em> table.
            </p>
            <p>
                <h1><u>Parent and Child Tables</u></h1>
            </p>
            <p>
                Parent tables are those which have tables linked to them in a one-to many
                relationship. The Matter table is often the Parent to numerous child
                tables. For example, the File Notes, Fee Notes and Reminders are all
                children of the Matter table.
            </p>
            <p><img src="/images/dbStructure/image3.png" alt=""></p>
            <p>
                Figure 3: The FeeNote table is linked to the Matter table by FN:MatterID =
                MAT:RecordID
            </p>
            <p>
                Notice that the link is based on the MatterID of the FeeNote (FN:MatterID)
                and the RecordID of the Matter (MAT:RecordID). This is a common pattern
                used in LegalSuite.
            </p>
            <p>
                Here is a list of the main tables and their prefixes:
            </p>
            <p><img src="/images/dbStructure/Table.png" style="width: 70%" alt=""></p>
            <br clear="all"/>
            <p>
                <h1><u>PARTY RELATIONSHIPS</u></h1>
            </p>
            <p><img src="/images/dbStructure/image4.png" alt=""></p>
            <p>
                Figure 5: Party relationships
            </p>
            <p>
                <h1><u>MATTER RELATIONSHIPS</u></h1>
            </p>
            <p><img src="/images/dbStructure/image5.png" alt=""></p>
            <p>
                Figure 6: Child tables linked to a Matter
            </p>
            <p>
                <strong>
                    <u>
                        <br/>
                        Conclusion
                    </u>
                </strong>
            </p>
            <p>
                The LegalSuite database comprises of over 200 tables, but the core of the
                program centres around the Matter and Party tables (and their parent tables
                and child tables).
            </p>
            <p>
                With an understanding of how these relate to each other, a 3<sup>rd</sup>
                party developer can access most of the most critical data required by a
                client.
            </p>
            
        </div>
    </div>
    
    
</div>
</div>


@endsection