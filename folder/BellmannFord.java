import java.util.*;
public class Bellmannford
{
	private int dist[];
	private int no_of_vertices;
	public static final int max=999;
	public static void main(String args[])
	{

		int source,no_of_vertices=0;
		Scanner sc=new Scanner(System.in);
		System.out.println("Enter the no. of vertices");
		no_of_vertices=sc.nextInt();
		int adjacencyMatrix[][]=new int[no_of_vertices+1][no_of_vertices+1];
		System.out.println("Enter the adjacency matrix");
		for(int sn=1;sn<=no_of_vertices;sn++)
		{
			for(int dn=1;dn<=no_of_vertices;dn++)
			{
				adjacencyMatrix[sn][dn]=sc.nextInt();
				if(sn==dn)
				{
					adjacencyMatrix[sn][dn]=0;
					continue;
				}
				if(adjacencyMatrix[sn][dn]==0)
				{
				       adjacencyMatrix[sn][dn]=max;
				}
       			}
       		}
       		System.out.println("Enter the source vertex");
       		source=sc.nextInt();
       		Bellmanford bf=new Bellmannford(no_of_vertices);
       		bf.shortestPath(source, adjacencyMatrix);
       		sc.close();
	}
        public  Bellmannford (int no_of_vertices)
	{
		this.no_of_vertices=no_of_vertices;
		dist=new int[no_of_vertices+1];
	}
	public void shortestPath(int source, int adjaencyMatrix[][])
	{
		for(int node=1;node<=no_of_vertices;node++)
		{
			dist[node]=max;
		}
		dist[source]=0;
		for(int node=1;node<=no_of_vertices;node++)
		{
    			for(int sn=1;sn<=no_of_vertices;sn++)
    			{
           			for(int dn=1;dn<=no_of_vertices;dn++)
   				{
         				if(adjacencyMatrix[sn][dn]!=max)
         				{
                				if(dist[dn]>dist[sn]+adjaencyMatrix[sn][dn])
                				{
                					dist[dn]=dist[sn]+adjacencyMatrix[sn][dn];
                				}
         				}
   				}
     			}
		}
		for(int sn=1;sn<=no_of_vertices;sn++)
		{
        		for(int dn=1;dn<=no_of_vertices;dn++)
			{
       				if(adjacencyMatrix[sn][dn]!=max)
        		 	{
                			if(dist[dn]>dist[sn]+adjacencyMatrix[sn][dn])
                			{
                				System.out.println("Graph encountered negative edge cycle");
                			}
         			}
 			}
		}
		for(int vertex=1;vertex<=no_of_vertices;vertex++)
		{
              		System.out.println("The distance from vertex"+source+" "+"to vertex" +vertex+" "+dist[vertex]);
		}
	}
}