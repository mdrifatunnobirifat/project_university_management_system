<!DOCTYPE html>
<html>
    <head>
        <title>AIUB Clone - Send Announcement</title>
        <link rel="stylesheet" href="../CSS/teacher.css">
    </head>
    <body>
        <center>
        <h2>
             <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">SEND ANNOUNCEMENT</label><br>
             <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>
    
        <div id="id1">
            <form style="background-color: white; padding: 20px; border-radius: 10px;">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Subject:</label>
                    <input type="text" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Target Audience:</label>
                    <select style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <option>All Students</option>
                        <option>All Teachers</option>
                        <option>Specific Course</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Message:</label>
                    <textarea style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"></textarea>
                </div>
                <button type="submit">Send Announcement</button>
            </form>
        </div>
        </center>
    </body>
</html>