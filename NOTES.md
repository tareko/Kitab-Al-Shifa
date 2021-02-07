Finding duplicate shifts:
```
SELECT 
    `user_id`, COUNT(`user_id`),
    `date`, COUNT(`date`),
    `shifts_type_id`, COUNT(`shifts_type_id`)

FROM
    shifts
    
GROUP BY 
    `user_id`,
    `date`,
    `shifts_type_id`
    
HAVING 
       (COUNT(`user_id`) > 1) AND 
       (COUNT(`date`) > 1) AND
       (COUNT(`shifts_type_id`) > 1)
```
