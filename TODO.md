# TODO

- [ ] Fix Eloquent model primary keys to avoid selecting a non-existent `id` column (Branch, Staff).
- [ ] Ensure eager-loading/select constraints include the correct primary key columns (`branch_id`, `staff_id`).
- [ ] Verify/patch any relationship or controller query that assumes `id` for Branch/Staff.
- [ ] Run a quick smoke test for the route that triggers SQLSTATE[42703].

