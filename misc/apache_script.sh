#!/usr/bin/env bash
echo "--- Apache ---"
inspect=("Logs" "Errors")

PS3="Which would you like to inspect? "
select opt in "${inspect[@]}"
do
    case $opt in 
        "Logs")
            read -p "How many entries would you like to read? " entries
            tail -n $entries /var/log/apache2/access.log
            break
            ;;
        "Errors")
            read -p "How many entries would you like to read? " entries
            tail -n $entries /var/log/apache2/error.log
            break
            ;;
        *)
            echo "Invalid option"
            break
            ;;
    esac
done

