# Introduction #

The Film Weekly dataset is derived from the Film Weekly trade publication which was in circulation in the mid 20th Century. The dataset is contains details of Cinemas that opened, closed, changed names, changed exhibitors and capacity during the period 1948/49 - 1971.

The spreadsheets contain the following columns:

| **Column Name** | **Description** |
|:----------------|:----------------|
| state           | an Australian state abbreviation |
| locality        | a locality type identifier |
| cinema type     | an identifier for the cinema type |
| latitude        | a latitude geo-coordinate in the decimal degrees format |
| longitude       | a longitude geo-coordinate in the decimal degrees format |
| street address  | the street address of the venue |
| post code       | the Australian postcode |
| suburb/town     | the name of the suburb |
| theatre nane    | the name of the theatre |
| exhibitor name  | the name of the exhibitor |
| capacity        | the capacity of the venue |
| 1 .. 22         | 22 columns indicating the time period of the data matching against FilmWeeklyCategories |

Each row in the spreadsheet represents with a new record or changes that have occurred during the year indicated in one the 22 category columns to the immediately proceeding record.

For example:

| **state** | **locality** | **cinema type** | **latitude** | **longitude** | **street address** | **postcode** | **suburb/town** | **theatre name** | **exhibitor name** | **capacity** | **1** | **2** | **3** | **4** | **5** | **6** | **7** | **8** | **9** | **10** | **11** | **12** | **13** | **14** | **15** | **16** | **17** | **18** | **19** | **20** | **21** | **22** |
|:----------|:-------------|:----------------|:-------------|:--------------|:-------------------|:-------------|:----------------|:-----------------|:-------------------|:-------------|:------|:------|:------|:------|:------|:------|:------|:------|:------|:-------|:-------|:-------|:-------|:-------|:-------|:-------|:-------|:-------|:-------|:-------|:-------|:-------|
| SA        | Central Business District | Cinema          | -34.92506    | 138.599927    | 104 King William Street | 5000         | Adelaide        | Majestic         | Fullers Theatres Pty. Ltd. | 1003         | 1948 - 1949 |       |       |       |       |       |       |       |       |        |        |        |        |        |        |        |        |        |        |        |        |        |
| SA        | Central Business District | Cinema          | -34.92506    | 138.599927    | 104 King William Street | 5000         | Adelaide        | Majestic         | Fullers Theatres Pty. Ltd. | 1021         |       | 1949 - 1950 |       |       |       |       |       |       |       |        |        |        |        |        |        |        |        |        |        |        |        |        |
| SA        | Central Business District | Cinema          | -34.92506    | 138.599927    | 104 King William Street | 5000         | Adelaide        | Majestic         | Celebrity Theatres Pty. Ltd. | 1013         |       |       |       |       |       | 1953 - 1954 | 1954 - 1955 | 1955 - 1956 |       |        |        |        |        |        |        |        |        |        |        |        |        |        |
| SA        | Central Business District | Cinema          | -34.92506    | 138.599927    | 104 King William Street | 5000         | Adelaide        | Majestic         | Celebrity Theatres Pty. Ltd. | 1083         |       |       |       |       |       |       |       |       | 1956 - 1957 | 1957 - 1958 | 1958 - 1959 |        |        |        |        |        |        |        |        |        |        |        |
| SA        | Central Business District | Cinema          | -34.92506    | 138.599927    | 104 King William Street | 5000         | Adelaide        | Majestic         | Celebrity Theatres Pty. Ltd. | 1003         |       |       |       |       |       |       |       |       |       |        |        | 1959 - 1960 | 1960 - 1961 | 1961 - 1962 | 1962 - 1963 | 1963 - 1964 | 1964 - 1965 | 1965 - 1966 |        |        |        |        |
| SA        | Central Business District | Cinema          | -34.92506    | 138.599927    | 104 King William Street | 5000         | Adelaide        | Her Majesty's    | Hoyts Theatres Ltd. | ?            |       |       |       |       |       |       |       |       |       |        |        |        |        |        |        |        |        |        |        | 1968 - 1969 |        |        |
| SA        | Central Business District | Cinema          | -34.92506    | 138.599927    | 104 King William Street | 5000         | Adelaide        | Warner           | Hindley St. Parking Centre | 728          |       |       |       |       |       |       |       |       |       |        |        |        |        |        |        |        |        |        |        |        | 1969 - 1970 | 1971   |