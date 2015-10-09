import java.util.Scanner;
public class Grouper 
{
	
	public static void main(String args[])
	{
		System.out.println("Welcome to Grouper the UCF mobile shopping app.");
		Grouper grouper = new Grouper();
		grouper.displayLoginMenu();
		System.out.println("complete");

	}
	
	public void displayLoginMenu()
	{
		int choice;
		Scanner keyboard = new Scanner(System.in);
		//user needs to interact with a database
		User user = new User();
		
		//menu text
		System.out.println("press 1:	login");
		System.out.println("press 2:	register");
		System.out.println("press 3:	exit");
		choice = keyboard.nextInt();
		
		//check if valid input
		if(choice > 3 || choice < 1)
		{
			System.out.println("invalid input");
			displayLoginMenu();
		}
		
		//switch statement for menu
		switch(choice)
		{
		case 1://attempt to login
			if(user.login())
			{
				//log in successful, proceed to user mode menu
				userMenu(user);
				
			}
			break;
		case 2:
			user.register();
			break;
		}
		
	}
	
	public static void userMenu(User user)
	{
		Scanner keyboard = new Scanner(System.in);
		int choice;
		//get user input
		System.out.println("user: " + user.getUserName() + " has logged in");
		System.out.println("1. Access Message Board");
		System.out.println("2. Make a search");
		System.out.println("3. Access private messages");
		System.out.println("4. Rate user");
		choice = keyboard.nextInt();
		
		//swtich statement for user input
		switch(choice)
		{
		case 1:
			//access message board
			/*
			 * should message board be its own class?
			 */
			break;
		case 2:
			//prompt user to choose what to search for
			int choice2;
			System.out.println("1. Search for listings");
			System.out.println("2. Search for shoppers");
			choice2 = keyboard.nextInt();
			
			switch(choice2)
			{
			case 1://search for other users shopping lists
				user.searchListings();
				break;
			case 2://search for other users to shop for you
				user.searchShoppers();
				break;
			}
		case 3://access PMs
			user.accessPM();
			break;
		case 4://rate other users
			/*
			 * users should only be able to rate users that they have already interacted with
			 * possibly keep record of interactions
			 * then user can look through list to find user to rate
			 * 
			 */
			break;
		} 
	}
	
	

}

/*
 * Users can:
 * 	Login
 * 	Register
 * 	Access message boards
 * 	Rate other users
 * 	Send/receive private message
 * 	Search for listings/ shoppers
 */
import java.util.Scanner;

public class User 
{
	private String userName;
	private String passWord;
	private Scanner keyboard;
	
	//default constructor
	public User()
	{
		this.userName = "John Doe";
		this.passWord = "GoKnigts!";
	}
	
	//constructor with known user/pass
	public User(String userName, String passWord)
	{
		this.userName = userName;
		this.passWord = passWord;
	}
	
	//getters
	public String getUserName()
	{
		return this.userName;
	}
	
	/*
	 * reads in user name and password from keyboard, then validates
	 */
	public boolean login()
	{
		String user, pass;
		keyboard = new Scanner(System.in);
		//query login information
		System.out.println("you are attempting to login");
		System.out.println("enter user name:");
		user = keyboard.nextLine();
		System.out.println("enter password:");
		pass = keyboard.nextLine();
		//check if given inputs match stored data
		if(user.equals(this.userName) || (user.equalsIgnoreCase(this.passWord)))
		{
			System.out.println("pass word is correct");
			return true;

		}
		else
		{
			System.out.println("Either the username or password was input wrong, try again");
			return false;
		}
	}
	
	public void searchListings()
	{
		
	}
	
	public void searchShoppers()
	{
		
	}
	
	public void register()
	{
		String user, pass;
		keyboard = new Scanner(System.in);
		//query user inputs
		System.out.println("you are registering a new account");
		System.out.println("Enter new user name");
		user = keyboard.nextLine();
		//check user against pre existing names in DB
		//if name is available continue, else ask for new name
		this.userName = user;
		//query user input
		System.out.println("Enter your password, must be more than 8 chars, and include at least 1 number");
		pass = keyboard.nextLine();
		//check that password matches requirements
		while(!checkPass(pass))
		{
			System.out.println("Enter your password, must be more than 8 chars, and include at least 1 number");
			pass = keyboard.nextLine();
		}
		
		//user name and password have been accepted, create new user
		User newUser = new User(user,pass);
		//add 

	}
	
	public boolean checkPass(String pass)
	{
		//check if password is sufficiently long
		if(pass.length() < 8)
		{
			//password too short, return false
			return false;
		}
		else
		{
			//check for a digit in the pasword
			for(int i = 0; i < pass.length(); i++)
			{
				//character at index i is a digit, return true
				if(Character.isDigit(pass.charAt(i)))
				{
					return true;
				}
			}
			//no digit was found, return false
			return false;
		}
	}
	
	public void accessPM()
	{
		System.out.println("Access Private Messages");
	}
}
