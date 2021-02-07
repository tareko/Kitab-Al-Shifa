Finding duplicate shifts:
```
SELECT 
    GROUP_CONCAT(`user_id`), COUNT(`user_id`),
    GROUP_CONCAT(`date`), COUNT(`date`),
    GROUP_CONCAT(`shifts_type_id`), COUNT(`shifts_type_id`)

FROM
    shifts

# To limit by `date` or `user_id`, uncomment the following line
# WHERE `date` >= '2021-05-01' AND `date` <= '2021-05-31' AND `user_id` != '507'
    
GROUP BY 
    `user_id`,
    `date`,
    `shifts_type_id`
    
HAVING 
       (COUNT(`user_id`) > 1) AND 
       (COUNT(`date`) > 1) AND
       (COUNT(`shifts_type_id`) > 1)
```
