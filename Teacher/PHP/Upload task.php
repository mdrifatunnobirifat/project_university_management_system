<!DOCTYPE html>
<html>
    <head>
        <title>AIUB Clone - Upload Task</title>
        <link rel="stylesheet" href="../CSS/teacher.css">
    </head>
    <body>
        <center>
        <h2>
             <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">UPLOAD TASK</label><br>
             <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>
    
        <div id="id1">
            <form style="background-color: white; padding: 20px; border-radius: 10px;">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Task Title:</label>
                    <input type="text" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Course:</label>
                    <select style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <option>CSE 101 - Programming Fundamentals</option>
                        <option>MAT 201 - Calculus I</option>
                        <option>ENG 101 - English Composition</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Due Date:</label>
                    <input type="date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Task Description:</label>
                    <textarea style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"></textarea>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Upload File:</label>
                    <input type="file" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <button type="submit">Upload Task</button>
            </form>
        </div>
        </center>
    </body>
</html>