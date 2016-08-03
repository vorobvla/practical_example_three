======================== README FOR ASDASDBLOG ===========================
============== (task for Networking and Automatic Testing) ===============
======================== by Vladimir Vorobyev ============================

This  folder contains my solution of the final task of Web Technologies course I attended at the Czech Technological University in Prague (CTU). The task was  designed by  the team of the course's teachers (Ing. V. Jirkovský and others).

The project is a web blog implemented in PHP  with Symfony framework (other technologies used: ORM Doctrine, twig) . It allows to log in and register users with different roles (the roles can be combined), browsing, posting, editing and commenting posts, filtering posts by author and tag (tag filtering is not implemented in the frontend). 

Here is a brief description of roles:
Reader		can read (browse details) and comment any posts 
Author		can create posts, edit or delete his own posts
Administrator	can create posts, edit or delete any posts, read (browse details) and comment any posts 
All users (including non-logged in)  can browse the list of posts. Without being Reader or Admin, he/she can't see posts marked as 'private'.

The project uses a remote database. The database access configuration file is not included into this repository. If you want to run the project, you can configure your own database (configuration file is app/config/parameters.yml). After that you will have to setup the database with command 'app/console/ doctrine:schema:create'.  You can also ask me for the configuration file that is set up for the database I use. Please, write on v.vorobyev.job@gmail.com, I will send it back to you.

