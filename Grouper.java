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
