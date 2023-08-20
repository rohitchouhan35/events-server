download the zip file and extract folder, the name of extracted folder will be "events-server-main"

place this foler in "htdocs" in xampp or anywhere you want and modify the "BASE_URL" here if needed [click to see file (https://github.com/rohitchouhan35/events-client/blob/main/src/services/eventData.js)]
by default the url ise set to "const BASE_URL_LOCAL = "http://localhost/events-server-main";"

http://localhost/events-server-main/list-all-events.php   -> to get all events

database is hosted with limit of 5Mb




**********sample for adding event: (POST request)**********

    request: 
            {
                "event_name": "Diwali",
                "start_time": "19/08/1999",
                "end_time": "25/08/2001",
                "location": "Vadodara",
                "description": "Diwali celebration event",
                "category": "Cultural",
                "banner_image": "dummy"
            }

    response:
            {
                "status": "201",
                "message": "added successfully"
            }


**********sample for getting events: (POST request)**********

    request:

        {
            "city": "Vadodara",
            "category": "Dance",
            "date": "04/08/2023"
        }

    response:

        {
            "status": 200,
            "message": "Successfully fetched data",
            "data": [
                {
                    "id": "30",
                    "event_name": "Mega event ",
                    "start_time": "17/08/2023",
                    "end_time": "25/08/2023",
                    "location": "Vadodara",
                    "description": "new event",
                    "category": "Dance",
                    "banner_image": "https://www.shutterstock.com/image-vector/music-event-banner-design-template-600w-1551185741.jpg"
                }
            ]
        }


**********Sample for adding user: (POST request) **********

    request:
        {
            "name": "Om",
            "email": "om@gmail.com"
        }

    response:
        {
            "status": "201",
            "message": "User added successfully"
        }


**********Sample for getting all users: (GET request)**********

    response:
        {
            "status": "200",
            "message": "Successfully fetched user data",
            "data": [
                {
                    "id": "1",
                    "name": "Om",
                    "email": "om@gmail.com"
                }
            ]
        }
